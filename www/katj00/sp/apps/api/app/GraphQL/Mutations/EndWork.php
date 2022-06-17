<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Project;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class EndWork
{
    /**
     * @param $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $project = Project::where("id", $args["id"])->where("user_id", $context->user()->getAuthIdentifier())->exists();
        if (!$project) {
            return Error::createLocatedError('Project doesn\'t exist!');
        }

        $currentWork = TrackedWorkHelper::getCurrentWork($args["id"]);
        if (!$currentWork) {
            return Error::createLocatedError('There is no work running!');
        }
        $endActivity = new Activity(["type" => "END", "work_id" => $currentWork["id"], "user_id" => $context->user()->getAuthIdentifier()]);
        if (array_key_exists("comment", $args)) {
            $endActivity["comment"] = $args["comment"];
        }
        $endActivity->trackedWork()->associate($currentWork);
        $endActivity->user()->associate($context->user());
        $endActivity->save();
        $currentWork->update(["end_id" => $endActivity['id']]);
        return ["type" => $endActivity['type'], "comment" => $endActivity["comment"], "work" => $currentWork, "created_at" => $endActivity['created_at'], "updated_at" => $endActivity['updated_at']];
    }
}
