<?php

namespace App\DTOs\Position;

use Spatie\DataTransferObject\DataTransferObject;

class PositionStoreDTO extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string */
    public $workplaceAddress;
    /** @var int */
    public $branchId;
    /** @var array */
    public $tags;
    /** @var \Carbon\Carbon|null */
    public $validFrom;
    /** @var \Carbon\Carbon|null */
    public $validUntil;
    /** @var int|null */
    public $salaryFrom;
    /** @var int|null */
    public $salaryTo;
    /** @var \App\DTOs\Position\PositionStoreCompanyDTO|null */
    public $company;
    /** @var string|null */
    public $externalUrl;
    /** @var int|null */
    public $minPracticeLength;
    /** @var string */
    public $content;

    public function hasCompany(): bool
    {
        return $this->company !== null;
    }
}
