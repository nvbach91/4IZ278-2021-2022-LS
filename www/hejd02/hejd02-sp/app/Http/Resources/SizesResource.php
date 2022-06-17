<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class SizesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['size_id' => "string", 'size_type' => "mixed", 'products' => "mixed", 'attributes' => "array"])] public function toArray($request): array
    {
        return [
            'size_id' => (string)$this->size_id,
            'size_type' => $this->size_type,
            'products' => $this->products,
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
