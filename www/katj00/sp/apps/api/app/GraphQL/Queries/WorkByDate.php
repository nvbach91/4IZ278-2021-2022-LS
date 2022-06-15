<?php

namespace App\GraphQL\Queries;

use App\Models\Project;
use App\Services\Time\TimeHelper;
use App\Services\TrackedWork\TrackedWorkHelper;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class WorkByDate
{
    /**
     * @param null $rootValue
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
        $workByDate = TrackedWorkHelper::workByDate($args['id'], $args['range']);
        $time = 0;
        foreach ($workByDate as $work) {
            $time += TimeHelper::timeDiff($work['activities']->toArray());
        }
        return ["id" => $project["id"], "name" => $project["name"], "represents" => $args["represents"], "date" => $args['range'], "time" => $time];
    }
}
