<?php

namespace App\GraphQL\Queries;

use App\Models\Project;
use App\Models\TrackedWork;
use App\Services\Time\TimeHelper;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Carbon;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\GraphQL\GraphQLClient;

final class ProjectInfo
{

    private $query = <<<'GRAPHQL'
        query getRepositoryInfo($id: ID!, $issueQuery: String!, $prQuery: String!){
           assignedIssues: search(first: 100, type: ISSUE, query: $issueQuery) {
            issueCount
          }
          assignedPR: search(first: 100, type: ISSUE, query: $prQuery) {
            issueCount
          }
          node(id: $id) {
            ... on Repository {
            languages(first: 5, orderBy: {field: SIZE, direction: DESC}) {
                  totalCount
                  edges {
                    size
                  node {
                    name
                  }
                }
              }
              collaborators {
                totalCount
              }
              owner {
                login
                url
              }
              isPrivate
              issues(states: OPEN) {
                totalCount
              }
              pullRequests(states:OPEN) {
                totalCount
              }
              defaultBranchRef {
                target {
                  ... on Commit {
                    history(first: 1) {
                      nodes {
                        messageHeadline
                        committedDate
                        url
                      }
                    }
                  }
                }
              }
            }
          }
        }
    GRAPHQL;

    /**
     * @param null $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (array_key_exists('id', $args)) {
            $project = Project::where('id', $args['id'])->where('user_id', $context->user()->getAuthIdentifier())->first();
        } else if (array_key_exists('name', $args)) {
            $project = Project::where('name', $args['name'])->where('user_id', $context->user()->getAuthIdentifier())->first();
        } else {
            return Error::createLocatedError('ProjectInfo arguments missmatch!');
        }
        $response = GraphQLClient::query(env("GITHUB_API_GRAPHQL"), $this->query, ["id" => $project['node_id'],
            "issueQuery" => "author:{$context->user()["username"]} type:issue repo:{$project["name"]} state:open",
            "prQuery" => "author:{$context->user()["username"]} type:pr repo:{$project["name"]} state:open"], $context->request()->bearerToken());
        $data = $response->json()["data"];
        $node = $data["node"];
        if (!is_null($node["defaultBranchRef"])) {
            $lastCommit = $node["defaultBranchRef"]["target"]["history"]["nodes"][0];
        } else {
            $lastCommit = ["messageHeadline" => "N/A", "committedDate" => null, "url" => null];
        }
        $currentWork = TrackedWorkHelper::getCurrentWork($project['id']);
        if ($currentWork) {
            $resultTime = TimeHelper::timeDiff($currentWork['activities']->toArray());
        } else {
            $resultTime = 0;
        }
        $lastWork = TrackedWorkHelper::getLastWork($project['id']);
        if ($lastWork->exists()) {
            $activity = TrackedWorkHelper::getLastActivity($lastWork->first());
        } else {
            $activity = null;
        }
        $languages = [];
        foreach ($node["languages"]["edges"] as $language) {
            $languages[] = ["size" => $language["size"], "name" => $language["node"]["name"]];
        }
        return [
            "id" => $project["id"],
            "name" => $project["name"],
            "collaborators" => $node["collaborators"]["totalCount"],
            "isPrivate" => $node["isPrivate"] ? "Private" : "Public",
            "owner" => $node["owner"],
            "languages" => $languages,
            "lastCommit" => [
                "messageHeadline" => $lastCommit["messageHeadline"],
                "committedDate" => is_null($lastCommit["committedDate"]) ? $lastCommit["committedDate"] : Carbon::parse($lastCommit["committedDate"]),
                "url" => $lastCommit["url"]
            ],
            "issues" => [
                "totalCount" => $node["issues"]["totalCount"],
                "assignedCount" => $data["assignedIssues"]["issueCount"]
            ],
            "pullRequests" => [
                "totalCount" => $node["pullRequests"]["totalCount"],
                "assignedCount" => $data["assignedPR"]["issueCount"]
            ],
            "status" => [
                "inProgress" => in_array($activity ? $activity['type'] : null, ["START", "CONTINUE"]),
                "lastAction" => $activity ? $activity['type'] : null,
                "timeSpent" => $resultTime
            ]
        ];
    }
}
