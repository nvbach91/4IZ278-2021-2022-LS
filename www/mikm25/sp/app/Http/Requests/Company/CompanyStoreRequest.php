<?php

namespace App\Http\Requests\Company;

use App\DTOs\Company\CompanyDTO;
use App\Models\Attributes\CompanySizeAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;
use function auth;

class CompanyStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'size' => [
                'nullable',
                'string',
                new In(array_keys(CompanySizeAttribute::getAllSizes())),
            ],
            'url' => 'nullable|string|url|max:255',
            'address' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|email|max:255',
        ];
    }

    public function toDTO(): CompanyDTO
    {
        return new CompanyDTO([
            'name' => (string) $this->input('name'),
            'size' => $this->filled('size')
                ? (string) $this->input('size')
                : null,
            'url' => $this->filled('url')
                ? (string) $this->input('url')
                : null,
            'address' => $this->filled('address')
                ? (string) $this->input('address')
                : null,
            'contactEmail' => $this->filled('contact_email')
                ? (string) $this->input('contact_email')
                : null,
        ]);
    }
}
