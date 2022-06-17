<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Project;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class PauseWork
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
        $lastAction = TrackedWorkHelper::getLastActivity($currentWork);
        if (!$currentWork) {
            return Error::createLocatedError('There is no work running!');
        }
        if ($lastAction["type"] == "PAUSE") {
            return Error::createLocatedError('This work is already paused!');
        }
        $pauseActivity = new Activity(["type" => "PAUSE", "work_id" => $currentWork["id"], "user_id" => $context->user()->getAuthIdentifier()]);
        if (array_key_exists("comment", $args)) {
            $pauseActivity["comment"] = $args["comment"];
        }
        $pauseActivity->trackedWork()->associate($currentWork);
        $pauseActivity->user()->associate($context->user());
        $pauseActivity->save();
        return ["type" => $pauseActivity['type'], "comment" => $pauseActivity["comment"], "work" => $currentWork, "created_at" => $pauseActivity['created_at'], "updated_at" => $pauseActivity['updated_at']];
    }
}
