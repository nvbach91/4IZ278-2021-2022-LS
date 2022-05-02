<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class MessageRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'email' => "string", 'subject' => "string", 'message' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'subject' => 'required|string|min:5',
            'message' => 'required|string|max:255'
        ];
    }
}
