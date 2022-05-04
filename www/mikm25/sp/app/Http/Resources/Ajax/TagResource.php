<?php

namespace App\Http\Resources\Ajax;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Tag $resource
 */
class TagResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
        ];
    }
}
