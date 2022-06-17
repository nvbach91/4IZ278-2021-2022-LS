<?php

namespace App\Services\Company;

use App\DTOs\Company\CompanyDTO;
use App\Models\Company;
use App\Models\User;

class CompanyService
{
    public function storeOrUpdate(CompanyDTO $companyDTO, ?Company $company = null): Company
    {
        $company = $company ?? new Company();

        /** @var User $user */
        $user = auth('web')->user();

        $company->user_id = $user->id;
        $company->name = $companyDTO->name;
        $company->size = $companyDTO->size;
        $company->url = $companyDTO->url;
        $company->address = $companyDTO->address;
        $company->contact_email = $companyDTO->contactEmail;

        $company->save();

        return $company;
    }
}
