<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['user_id' => "string", 'address_id' => "string", 'products' => "string", 'note' => "string"])] public function rules(): array
    {
        return [
            'user_id' => 'required|exists:App\Models\User,user_id|min:1|numeric',
            'address_id' => 'required|exists:App\Models\Address,id|min:1|numeric',
            'products' => 'required|array',
            'note' => 'string'
        ];
    }
}
