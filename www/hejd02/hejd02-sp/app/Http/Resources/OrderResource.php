<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
   #[ArrayShape(['order_id' => "string", 'address_id' => "string", 'user' => "mixed", 'status' => "mixed", 'note' => "mixed", 'products' => "array", 'address' => "array", 'attributes' => "array"])] public function toArray($request): array
   {
        return [
            'order_id' => (string)$this->order_id,
            'address_id' => (string)$this->address_id,
            'user' => $this->user,
            'status' => $this->status,
            'note' => $this->note,
            'products' => [
                $this->product_size
            ],
            'address' => [
                $this->address
            ],
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
