<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['user_id ' => "string", 'region' => "mixed", 'town' => "mixed", 'street' => "mixed", 'street_number' => "mixed", 'zip' => "mixed", 'user' => "mixed", 'attributes' => "array"])] public function toArray($request)
    {
        return [
            'user_id ' => (string)$this->user_id,
            'region' => $this->region,
            'town' => $this->town,
            'street' => $this->street,
            'street_number' => $this->street_number,
            'zip' => $this->zip,
            'user' => $this->user,
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
