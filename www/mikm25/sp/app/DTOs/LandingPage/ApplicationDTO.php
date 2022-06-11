<?php

namespace App\DTOs\LandingPage;

use Spatie\DataTransferObject\DataTransferObject;

class ApplicationDTO extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string */
    public $email;
    /** @var string|null */
    public $phone;
    /** @var string */
    public $message;
}
