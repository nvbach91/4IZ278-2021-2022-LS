<?php

namespace App\GraphQL\Queries;

use App\Models\Project;
use App\Services\Time\TimeHelper;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class LastWork
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
        if (!$project->exists()) {
            return Error::createLocatedError('Project doesn\'t exist!');
        }
        $work = TrackedWorkHelper::getPreviousWork($args['id']);
        if (!$work) {
            return ["id" => $project["id"], "name" => $project["name"], "represents" => "lastWork", "date" => ["from" => null, "to" => null], "time" => 0];
        }
        $time = TimeHelper::timeDiff($work['activities']->toArray());

        return ["id" => $project["id"], "name" => $project["name"], "represents" => "lastWork", "date" => ["from" => $work['created_at'], "to" => $work["updated_at"]], "time" => $time];
    }
}
