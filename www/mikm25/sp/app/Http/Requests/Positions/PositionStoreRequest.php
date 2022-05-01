<?php

namespace App\Http\Requests\Positions;

use App\Models\Attributes\CompanySizeAttribute;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\In;

class PositionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $userId = auth()->user()->id;

        return [
            'name' => 'required|string|max:255',
            'workplace_address' => 'required|string|max:255',
            'branch' => [
                'required',
                'integer',
                new Exists(Branch::class, 'id'),
            ],
            'tags' => 'nullable|array|max:5',
            'tags.*' => 'nullable|string|max:30',
            'valid_from' => 'nullable|date|before:valid_until',
            'valid_until' => 'nullable|date|after:valid_from',
            'salary_from' => 'nullable|integer|lte:salary_to|gte:0',
            'salary_to' => 'nullable|integer|gte:salary_from|gte:0',
            'with_company' => 'required|boolean',
            'company.id' => [
                'nullable',
                'integer',
                (new Exists(Company::class, 'id'))->where('user_id', $userId),
            ],
            'company.name' => 'required_if:with_company,1|nullable|string|max:255',
            'company.size' => [
                'nullable',
                'string',
                new In(array_keys(CompanySizeAttribute::getAllSizes())),
            ],
            'company.url' => 'nullable|string|url|max:255',
            'company.address' => 'nullable|string|max:255',
            'company.contact_email' => 'nullable|string|email|max:255',
            'external_url' => 'nullable|string|url|max:255',
            'min_practice_length' => 'nullable|integer|gte:0',
            'content' => 'required|string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            // company switch workaround
            'with_company' => $this->has('with_company')
        ]);
    }
}
