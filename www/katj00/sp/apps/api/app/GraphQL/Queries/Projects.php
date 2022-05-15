<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Projects
{

    private $query = <<<'GRAPHQL'
    query {
        viewer {
            repositories(first: 25) {
              edges {
                cursor
                node {
                  id
                  name
                  languages(first: 5 orderBy: {direction: DESC, field: SIZE}) {
                    edges {
                      node {
                        id
                        name
                        color
                        size
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
        \GraphQLClient::query(env("GITHUB_API_GRAPHQL"), $this->query, [], $context->request()->bearerToken());
        return $context->user()->getAuthIdentifier();
    }
}
