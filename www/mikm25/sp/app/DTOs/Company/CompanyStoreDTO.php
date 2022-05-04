<?php

namespace App\DTOs\Company;

use Spatie\DataTransferObject\DataTransferObject;

class CompanyStoreDTO extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string|null */
    public $size;
    /** @var string|null */
    public $url;
    /** @var string|null */
    public $address;
    /** @var string|null */
    public $contactEmail;
}
