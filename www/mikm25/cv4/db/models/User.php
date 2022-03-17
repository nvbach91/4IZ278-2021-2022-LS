<?php

class User
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @param array<string,mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->name = (string) $attributes['name'];
        $this->email = (string) $attributes['email'];
        $this->password = (string) $attributes['password'];
    }

    /**
     * @param array<int,mixed> $row
     */
    public static function fromCsvRow(array $row): self
    {
        return new self([
            'name' => $row[0],
            'email' => $row[1],
            'password' => $row[2],
        ]);
    }
}