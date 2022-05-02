<?php

namespace App\DTOs\Position;

use Spatie\DataTransferObject\DataTransferObject;

class PositionStoreCompanyDTO extends DataTransferObject
{
    /** @var int|null */
    public $id;
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
