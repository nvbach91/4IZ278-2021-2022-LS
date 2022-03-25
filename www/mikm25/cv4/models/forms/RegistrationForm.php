<?php

require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/../../db/UserDatabase.php';

class RegistrationForm extends Form
{

    /**
     * @var string|null
     */
    private $name;


    /**
     * @var string|null
     */
    private $email;


    /**
     * @var string|null
     */
    private $password;


    /**
     * @var string|null
     */
    private $passwordConfirmation;

    /**
     * @inheritdoc
     */
    protected function initFromData(array $data): void
    {
        $this->name = isset($data['name']) && ! empty($data['name'])
            ? (string) $data['name']
            : null;
        $this->email = isset($data['email']) && ! empty($data['email'])
            ? (string) $data['email']
            : null;
        $this->password = isset($data['password']) && ! empty($data['password'])
            ? (string) $data['password']
            : null;
        $this->passwordConfirmation = isset($data['passwordConfirm']) && ! empty($data['passwordConfirm'])
            ? (string) $data['passwordConfirm']
            : null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): ?string
    {
        return $this->passwordConfirmation;
    }

    /**
     * @inheritdoc
     */
    public function validateForm(): bool
    {
        $valid = true;

        $db = new UserDatabase();

        if (empty($this->name)) {
            $valid = false;
            $this->addError('name', "You must fill the name.");
        }

        if (empty($this->email)) {
            $valid = false;
            $this->addError('email', "You must fill the email.");
        } elseif (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $this->addError('email', "The email must be a valid email address.");
        } elseif ($db->fetchUserByEmail($this->email) !== null) {
            $valid = false;
            $this->addError('email', "This email is already taken.");
        }

        if (empty($this->password)) {
            $valid = false;
            $this->addError('password', "You must fill the password.");
        }

        if (empty($this->passwordConfirmation)) {
            $valid = false;
            $this->addError('passwordConfirm', "You must fill the password confirmation.");
        } elseif ($this->password !== $this->passwordConfirmation) {
            $valid = false;
            $this->addError('passwordConfirm', "Password confirmation does not match.");
        }

        return $valid;
    }

    public function flushFields(): void
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->passwordConfirmation = null;
    }
}
