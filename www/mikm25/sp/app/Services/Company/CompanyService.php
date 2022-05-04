<?php

namespace App\Services\Company;

use App\DTOs\Company\CompanyDTO;
use App\Models\Company;

class CompanyService
{
    public function store(CompanyDTO $companyDTO): Company
    {
        $company = new Company();

        $company->user_id = auth('web')->user()->id;
        $company->name = $companyDTO->name;
        $company->size = $companyDTO->size;
        $company->url = $companyDTO->url;
        $company->address = $companyDTO->address;
        $company->contact_email = $companyDTO->contactEmail;

        $company->save();

        return $company;
    }

    public function update(Company $company, CompanyDTO $companyDTO): Company
    {
        $company->name = $companyDTO->name;
        $company->size = $companyDTO->size;
        $company->url = $companyDTO->url;
        $company->address = $companyDTO->address;
        $company->contact_email = $companyDTO->contactEmail;

        $company->save();

        return $company;
    }
}
