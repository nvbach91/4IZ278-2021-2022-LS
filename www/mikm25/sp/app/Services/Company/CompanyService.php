<?php

namespace App\Services\Company;

use App\DTOs\Position\PositionStoreCompanyDTO;
use App\Models\Company;

class CompanyService
{
    public function store(PositionStoreCompanyDTO $companyDTO): Company
    {
        $company = new Company();

        $company->user_id = auth()->user()->id;
        $company->name = $companyDTO->name;
        $company->size = $companyDTO->size;
        $company->url = $companyDTO->url;
        $company->address = $companyDTO->address;
        $company->contact_email = $companyDTO->contactEmail;

        $company->save();

        return $company;
    }
}
