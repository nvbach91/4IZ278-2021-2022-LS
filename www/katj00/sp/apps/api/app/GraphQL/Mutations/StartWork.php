<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Project;
use App\Models\TrackedWork;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class StartWork
{
    /**
     * @param $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $project = Project::where("id", $args["id"])->where("user_id", $context->user()->getAuthIdentifier())->first();
        if (!$project) {
            return Error::createLocatedError('Project doesn\'t exist!');
        }

        if (TrackedWorkHelper::getCurrentWork($args["id"])) {
            return Error::createLocatedError('Work is already tracked!');
        }
        $trackedWork = new TrackedWork([]);
        $trackedWork->user()->associate($context->user());
        $trackedWork->project()->associate($project);
        $trackedWork->save();
        $action = new Activity(["type" => "START", "work_id" => $trackedWork["id"], "user_id" => $context->user()->getAuthIdentifier()]);
        $action->user()->associate($context->user());
        $action->trackedWork()->associate($trackedWork);
        $action->save();
        $trackedWork['start_id'] = $action['id'];
        $trackedWork->save();
        return ["type" => $action['type'], "work" => $trackedWork, "created_at" => $action['created_at'], "updated_at" => $action['updated_at']];
    }
}
