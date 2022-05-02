<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['product_id' => "string", 'type' => "string", 'category' => "\App\Http\Resources\CategoryResource", 'size' => "mixed", 'attributes' => "array"])] public function toArray($request)
    {
        $cat = new CategoryResource($this->category);

        return [
            'product_id' => (string)$this->product_id,
            'type' => 'Products',
            'category' => $cat,
            'size' => $this->size,
            'attributes' => [
                'product_name' => $this->product_name,
                'price' => (string)$this->price,
                'color' => $this->color,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
