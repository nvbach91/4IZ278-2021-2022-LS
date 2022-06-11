<?php

namespace App\Http\Requests\Position;

use App\DTOs\Position\PositionDTO;
use App\Models\Attributes\PositionWorkloadAttribute;
use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\In;

class PositionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    public function rules(): array
    {
        /** @var User $user */
        $user = auth('web')->user();

        return [
            'name' => 'required|string|max:255',
            'workplace_address' => 'required|string|max:255',
            'branch' => [
                'required',
                'integer',
                new Exists(Branch::class, 'id'),
            ],
            'workload' => [
                'required',
                'string',
                new In(array_keys(PositionWorkloadAttribute::getAllWorkloads())),
            ],
            'tags' => 'nullable|array|max:5',
            'tags.*' => 'nullable|string|max:30',
            'valid_from' => 'nullable|date|before_or_equal:valid_until',
            'valid_until' => 'nullable|required_with:valid_from|date|after_or_equal:valid_from',
            'salary_from' => 'nullable|required_with:salary_to|integer|lte:salary_to|gte:0',
            'salary_to' => 'nullable|required_with:salary_from|integer|gte:salary_from|gte:0',
            'company' => [
                'nullable',
                'integer',
                (new Exists(Company::class, 'id'))->where('user_id', $user->id),
            ],
            'external_url' => 'nullable|string|url|max:255',
            'min_practice_length' => 'nullable|integer|gte:0',
            'content' => 'required|string|min:300',
        ];
    }

    public function toDTO(): PositionDTO
    {
        // remove all empty tags and cast them to string
        $tags = array_map(static function ($value): string {
            return (string) $value;
        }, array_filter($this->input('tags', [])));

        return new PositionDTO([
            'name' => (string) $this->input('name'),
            'workplaceAddress' => (string) $this->input('workplace_address'),
            'branchId' => (int) $this->input('branch'),
            'workload' => (string) $this->input('workload'),
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
