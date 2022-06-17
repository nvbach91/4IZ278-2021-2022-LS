<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CompanyDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! auth('web')->check()) {
            return false;
        }

        /** @var User $user */
        $user = auth('web')->user();

        /** @var Company $company */
        $company = $this->route('company');

        return $company->user_id === $user->id;
    }

    public function rules(): array
    {
        return [];
    }
}
