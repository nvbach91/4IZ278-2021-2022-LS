<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['user_id ' => "string", 'type' => "string", 'role' => "mixed", 'first_name' => "mixed", 'last_name' => "mixed", 'phone' => "mixed", 'email' => "mixed", 'address' => "mixed", 'attributes' => "array"])] public function toArray($request): array
    {
        return [
            'user_id ' => (string)$this->user_id,
            'type' => 'User',
            'role' => $this->role,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'orders' => $this->orders,
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
