<?php

/**
 * Class used to manage password hashing so we don't store the in their
 * raw form!
 */
class PasswordBroker
{

    /**
     * Hashes given password using bcrypt
     */
    public static function hashPassword(string $rawPassword): string
    {
        return password_hash($rawPassword, PASSWORD_BCRYPT);
    }

    /**
     * Verifies given password against given hash
     */
    public static function verify(string $rawPassword, string $hashedPassword): bool
    {
        return password_verify($rawPassword, $hashedPassword);
    }
}