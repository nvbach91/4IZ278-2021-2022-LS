<?php

abstract class Form
{

    /**
     * @var bool|null (null = not validated yet)
     */
    protected $valid = null;

    /**
     * @var array<string,list<string>>
     */
    protected $errors = [];

    /**
     * @param null|array<string,scalar> $data
     */
    public function __construct(array $data = [])
    {
        $this->initFromData($data);
    }

    /**
     * @param array<string,scalar> $data
     * @return static
     */
    public static function fromData(array $data)
    {
        return new static($data);
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
        if (! $this->wasValidated()) {
            return '';
        }

        return $this->isFieldInvalid($fieldName) ? 'is-invalid' : 'is-valid';
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
        $this->errors = [];
        $this->valid = null;

        $this->flushFields();
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

    public function validate(): bool
    {
        return ($this->valid = $this->validateForm());
    }

    protected function addError(string $fieldName, string $error): void
    {
        if (! array_key_exists($fieldName, $this->errors)) {
            $this->errors[$fieldName] = [];
        }

        $this->errors[$fieldName][] = $error;
    }

    /**
     * Flushes all fields, meaning it resets them
     */
    public abstract function flushFields(): void;

    /**
     * Validates the form and returns the result of the validation
     * FALSE = invalid, TRUE = valid
     */
    public abstract function validateForm(): bool;

    /**
     * Init params from given array data, usually from $_POST
     * @param null|array<string,scalar> $data
     */
    protected abstract function initFromData(array $data): void;
}