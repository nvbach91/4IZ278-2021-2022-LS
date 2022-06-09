<?php

namespace App\DTOs\Position;

use Spatie\DataTransferObject\DataTransferObject;

class PositionDTO extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string */
    public $workplaceAddress;
    /** @var int */
    public $branchId;
    /** @var string */
    public $workload;
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
    /** @var int|null */
    public $company;
    /** @var string|null */
    public $externalUrl;
    /** @var int|null */
    public $minPracticeLength;
    /** @var string */
    public $content;
}
