<?php

namespace App\GraphQL\Queries;

use App\Models\Project;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class ActivityLog
{
    /**
     * @param $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        if (!array_key_exists('name', $args)) {
            $project = Project::where("id", $args['id'])->where("user_id", $context->user()->getAuthIdentifier())->first();
        } else {
            $project = Project::where("name", $args['name'])->where("user_id", $context->user()->getAuthIdentifier())->first();
        }
        $list = TrackedWorkHelper::getLog($project['id']);
        $result = [];
        foreach ($list as $work) {
            $result[] = ["date" => $work['created_at'], "id" => $work["id"], "activities" => $work["activities"]];
        }
        return ["id" => $project['id'], "name" => $project['name'], "log" => $result];
    }
}
