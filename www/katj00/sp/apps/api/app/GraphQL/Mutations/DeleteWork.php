<?php

namespace App\GraphQL\Mutations;

use App\Models\TrackedWork;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class DeleteWork
{
    /**
     * @param $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return TrackedWork|Error
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $toDelete = TrackedWork::where("id", $args["id"])->where("user_id", $context->user()->getAuthIdentifier())->first();
        if (!$toDelete) {
            return Error::createLocatedError('You don\'t have enough permission to do this!');
        }
        print_r($toDelete);
        return $toDelete;
    }
}
