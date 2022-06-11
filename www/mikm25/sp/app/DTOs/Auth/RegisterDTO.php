<?php

namespace App\DTOs\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterDTO extends DataTransferObject
{
    /** @var string */
    public $firstName;
    /** @var string */
    public $lastName;
    /** @var string */
    public $email;
    /** @var string|null */
    public $phone;
    /** @var string|null */
    public $password;
    /** @var int|null */
    public $githubId;
}
