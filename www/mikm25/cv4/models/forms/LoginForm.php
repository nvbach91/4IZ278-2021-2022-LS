<?php

require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/../../db/UserDatabase.php';
require_once __DIR__ . '/../PasswordBroker.php';

class LoginForm extends Form
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @inheritdoc
     */
    protected function initFromData(array $data): void
    {
        $this->email = isset($data['email']) && ! empty($data['email'])
            ? (string) $data['email']
            : null;
        $this->password = isset($data['password']) && ! empty($data['password'])
            ? (string) $data['password']
            : null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function validateForm(): bool
    {
        $valid = true;

        if (empty($this->email)) {
            $valid = false;
            $this->addError('email', "You must fill the email.");
        } elseif (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $this->addError('email', "The email must be a valid email address.");
        }

        if (empty($this->password)) {
            $valid = false;
            $this->addError('password', "You must fill the password.");
        }

        // Check user in DB
        if ($valid) {
            $user = (new UserDatabase())->fetchUserByEmail($this->email);

            if ($user === null) {
                $valid = false;
                $this->addError('email', "User with this email does not exist.");
            } elseif (!PasswordBroker::verify($this->password, $user->password)) {
                $valid = false;
                $this->addError('password', "Wrong password.");
            }
        }

        return $valid;
    }

    public function flushFields(): void
    {
        $this->email = null;
        $this->password = null;
    }
}