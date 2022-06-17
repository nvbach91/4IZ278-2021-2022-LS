<?php

namespace App\DTOs\User;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    /** @var string */
    public $firstname;
    /** @var string */
    public $lastname;
    /** @var string|null */
    public $phone;
    /** @var string|null */
    public $email;
    /** @var string|null */
    public $newPassword;
}
