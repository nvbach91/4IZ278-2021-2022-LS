<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use App\Models\User;

class CompanyUpdateRequest extends CompanyStoreRequest
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

        return $user->id === $company->user_id;
    }
}
