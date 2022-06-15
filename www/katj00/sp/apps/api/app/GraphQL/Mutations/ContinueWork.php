<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Project;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class ContinueWork
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
        if(!$lastAction) {
            return Error::createLocatedError('There is no work running!');
        } else if($lastAction["type"] !== "PAUSE") {
            return Error::createLocatedError('You have to pause the work first!');
        }
        $continueActivity = new Activity(["type" => "CONTINUE", "work_id" => $currentWork["id"], "user_id" => $context->user()->getAuthIdentifier()]);
        $continueActivity->trackedWork()->associate($currentWork);
        $continueActivity->user()->associate($context->user());
        $continueActivity->save();
        return ["type" => $continueActivity['type'], "work" => $currentWork, "created_at" => $continueActivity['created_at'], "updated_at" => $continueActivity['updated_at']];
;
    }
}
