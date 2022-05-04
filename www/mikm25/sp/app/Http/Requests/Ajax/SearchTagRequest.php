<?php

namespace App\Http\Requests\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class SearchTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'query' => 'nullable|string'
        ];
    }

    public function getQuery(): ?string
    {
        return $this->get('query');
    }
}
