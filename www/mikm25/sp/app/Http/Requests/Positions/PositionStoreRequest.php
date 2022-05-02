<?php

namespace App\Http\Requests\Positions;

use App\DTOs\Position\PositionStoreCompanyDTO;
use App\DTOs\Position\PositionStoreDTO;
use App\Models\Attributes\CompanySizeAttribute;
use App\Models\Branch;
use App\Models\Company;
use Carbon\Carbon;
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

        $today = Carbon::now()->format('Y-m-d');

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
            'valid_from' => "nullable|date|before:valid_until|gte:$today",
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
            'with_company' => $this->has('with_company'),
        ]);
    }

    public function toDTO(): PositionStoreDTO
    {
        if ($this->boolean('with_company')) {
            $companyDTO = new PositionStoreCompanyDTO([
                'id' => $this->filled('company.id')
                    ? (int) $this->input('company.id')
                    : null,
                'name' => (string) $this->input('company.name'),
                'size' => $this->filled('company.size')
                    ? (string) $this->input('company.size')
                    : null,
                'url' => $this->filled('company.url')
                    ? (string) $this->input('company.url')
                    : null,
                'address' => $this->filled('company.address')
                    ? (string) $this->input('company.address')
                    : null,
                'contactEmail' => $this->filled('company.contact_email')
                    ? (string) $this->input('company.contact_email')
                    : null,
            ]);
        } else {
            $companyDTO = null;
        }

        // remove all empty tags and cast them to string
        $tags = array_map(static function ($value): string {
            return (string) $value;
        }, array_filter($this->input('tags', [])));

        return new PositionStoreDTO([
            'name' => (string) $this->input('name'),
            'workplaceAddress' => (string) $this->input('workplace_address'),
            'branchId' => (int) $this->input('branch'),
            'tags' => $tags,
            'validFrom' => $this->filled('valid_from')
                ? Carbon::parse((string) $this->input('valid_from'))
                : null,
            'validUntil' => $this->filled('valid_until')
                ? Carbon::parse((string) $this->input('valid_until'))
                : null,
            'salaryFrom' => $this->filled('salary_from')
                ? (int) $this->input('salary_from')
                : null,
            'salaryTo' => $this->filled('salary_to')
                ? (int) $this->input('salary_to')
                : null,
            'company' => $companyDTO,
            'externalUrl' => $this->filled('external_url')
                ? (string) $this->input('external_url')
                : null,
            'minPracticeLength' => $this->filled('min_practice_length')
                ? (int) $this->input('min_practice_length')
                : null,
            'content' => (string) $this->input('content'),
        ]);
    }
}
