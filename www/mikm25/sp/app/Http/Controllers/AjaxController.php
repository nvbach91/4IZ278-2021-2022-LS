<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ajax\SearchTagRequest;
use App\Http\Resources\Ajax\TagResource;
use App\Models\Builders\TagBuilder;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AjaxController extends Controller
{
    public function searchTags(SearchTagRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = auth('web')->user();

        $tags = Tag::query()
            ->when(! empty($request->getQuery()), static function (TagBuilder $builder) use ($request): TagBuilder {
                /** @var string $query */
                $query = $request->getQuery();

                return $builder->searchByQuery($query);
            })
            ->ofUserId($user->id)
            ->limit(5)
            ->get();

        return TagResource::collection($tags)->toResponse($request);
    }
}
