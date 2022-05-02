<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    #[ArrayShape(['user_id' => "string", 'region' => "string", 'town' => "string", 'street' => "string", 'street_number' => "string", 'zip' => "string"])] public function rules(): array
    {
        return [
            'user_id' => 'required|exists:App\Models\User,user_id|min:1|numeric',
            'region' => 'required|string|max:100',
            'town' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'street_number' => 'required|max:20',
            'zip' => 'required|max:20',
        ];
    }
}
