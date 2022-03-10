<?php

class SignupForm
{
    private const GENDER_FEMALE = 'female',
        GENDER_MALE = 'male',
        GENDER_FLUID = 'fluid',
        GENDER_OTHER = 'other';

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $gender;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $profilePicture;

    /**
     * @var string|null
     */
    private $deckName;

    /**
     * @var int|null
     */
    private $deckNumber;

    /**
     * @var bool|null (null = not validated yet)
     */
    private $valid = null;

    /**
     * @var array<string,list<string>>
     */
    private $errors = [];

    /**
     * @param null|array<string,scalar> $data
     */
    public function __construct(array $data = [])
    {
        $this->initFromData($data);
    }

    /**
     * @param array<string,scalar> $data
     */
    public static function fromData(array $data): self
    {
        return new self($data);
    }

    /**
     * @param array<string,scalar> $data
     */
    private function initFromData(array $data): void
    {
        $this->name = isset($data['name']) && ! empty($data['name'])
            ? (string) $data['name']
            : null;
        $this->gender = isset($data['gender']) && ! empty($data['gender'])
            ? (string) $data['gender']
            : null;
        $this->email = isset($data['email']) && ! empty($data['email'])
            ? (string) $data['email']
            : null;
        $this->phone = isset($data['phone']) && ! empty($data['phone'])
            ? (string) $data['phone']
            : null;
        $this->profilePicture = isset($data['profilePic']) && ! empty($data['profilePic'])
            ? (string) $data['profilePic']
            : null;
        $this->deckName = isset($data['deckName']) && ! empty($data['deckName'])
            ? (string) $data['deckName']
            : null;
        $this->deckNumber = isset($data['deckNumber']) && ! empty($data['deckNumber']) && is_numeric($data['deckNumber'])
            ? (int) $data['deckNumber']
            : null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function getDeckName(): ?string
    {
        return $this->deckName;
    }

    public function getDeckNumber(): ?int
    {
        return $this->deckNumber;
    }

    /**
     * @return array<string,string>
     */
    public static function getGenders(): array
    {
        return [
            self::GENDER_FEMALE => 'Female',
            self::GENDER_MALE => 'Male',
            self::GENDER_FLUID => 'Gender fluid',
            self::GENDER_OTHER => 'Other',
        ];
    }

    /**
     * Checks if the field is invalid and has errors
     */
    public function isFieldInvalid(string $fieldName): bool
    {
        return array_key_exists($fieldName, $this->errors) &&
            ! empty($this->errors[$fieldName]);
    }

    public function getFieldValidityClass(string $fieldName): string
    {
        if (!$this->wasValidated()) {
            return '';
        }

        return $this->isFieldInvalid($fieldName) ? 'is-invalid' : 'is-valid';
    }

    /**
     * Validates the form and returns the result of the validation
     * FALSE = invalid
     * TRUE = valid
     */
    public function validate(): bool
    {
        $valid = true;

        if (empty($this->name)) {
            $valid = false;
            $this->addError('name', "You must fill the name.");
        }

        if (empty($this->gender)) {
            $valid = false;
            $this->addError('gender', "You must fill the gender.");
        } elseif (! array_key_exists($this->gender, self::getGenders())) {
            $valid = false;
            $this->addError('gender', "The gender value is not valid.");
        }

        if (empty($this->email)) {
            $valid = false;
            $this->addError('email', "You must fill the email.");
        } elseif (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $this->addError('email', "The email must be a valid email address.");
        }

        if (empty($this->phone)) {
            $valid = false;
            $this->addError('phone', "You must fill the phone number.");
        }

        if (empty($this->profilePicture)) {
            $valid = false;
            $this->addError('profilePic', "You must fill the profile picture URL address.");
        } elseif (! filter_var($this->profilePicture, FILTER_VALIDATE_URL)) {
            $valid = false;
            $this->addError('profilePic', "The address of the profile picture must be a valid URL address.");
        }

        if (empty($this->deckName)) {
            $valid = false;
            $this->addError('deckName', "You must fill the deck name.");
        }

        if (empty($this->deckNumber)) {
            $valid = false;
            $this->addError('deckNumber', "You must fill the number of cards in your deck.");
        } elseif ($this->deckNumber <= 0) {
            $valid = false;
            $this->addError('deckNumber', "Number of cards in the deck must be greater than 0.");
        }

        return ($this->valid = $valid);
    }

    public function wasValidated(): bool
    {
        return $this->valid !== null;
    }

    public function isInvalid(): bool
    {
        return $this->valid === false;
    }

    public function isValid(): bool
    {
        return $this->valid === true;
    }

    public function flush(): void
    {
        $this->name = null;
        $this->gender = null;
        $this->email = null;
        $this->phone = null;
        $this->profilePicture = null;
        $this->deckName = null;
        $this->deckNumber = null;

        $this->errors = [];

        $this->valid = null;
    }

    /**
     * @return list<string>
     */
    public function getFieldErrors(string $fieldName): array
    {
        if (! array_key_exists($fieldName, $this->errors)) {
            return [];
        }

        return $this->errors[$fieldName];
    }

    private function addError(string $fieldName, string $error): void
    {
        if (! array_key_exists($fieldName, $this->errors)) {
            $this->errors[$fieldName] = [];
        }

        $this->errors[$fieldName][] = $error;
    }
}