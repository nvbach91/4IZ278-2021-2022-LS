<?php

namespace App\GraphQL\Mutations;

use App\Services\Synchronize\SynchronizeHelper;
use App\Models\Project;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Synchronize
{
    /**
     * @param null $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $userID = $context->user()->getAuthIdentifier();
        $node_id = $context->user()['node_id'];
        $token = $context->request()->bearerToken();
        return SynchronizeHelper::synchronize($userID, $token);
    }
}
