<?php

namespace App\Http\Requests\LandingPage;

use App\DTOs\LandingPage\ReactionDTO;
use Illuminate\Foundation\Http\FormRequest;

class ReactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function toDTO(): ReactionDTO
    {
        return new ReactionDTO([
            'name' => (string) $this->input('name'),
            'email' => (string) $this->input('email'),
            'phone' => $this->filled('phone') ? (string) $this->input('phone') : null,
            'message' => (string) $this->input('message'),
        ]);
    }
}
