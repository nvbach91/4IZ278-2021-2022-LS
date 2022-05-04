<?php

namespace App\Http\Requests\Positions;

use App\DTOs\Position\PositionStoreDTO;
use App\Models\Branch;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class PositionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    public function rules(): array
    {
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
            'company' => [
                'nullable',
                'integer',
                (new Exists(Company::class, 'id'))->where('user_id', auth('web')->check()),
            ],
            'external_url' => 'nullable|string|url|max:255',
            'min_practice_length' => 'nullable|integer|gte:0',
            'content' => 'required|string',
        ];
    }

    public function toDTO(): PositionStoreDTO
    {
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
            'company' => $this->filled('company')
                ? (int) $this->input('company')
                : null,
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
