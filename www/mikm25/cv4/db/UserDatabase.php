<?php

require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/../models/PasswordBroker.php';

class UserDatabase
{

    private const CSV_SEPARATOR = ';';

    /**
     * @return list<User>
     */
    public function fetchUsers(): array
    {
        $users = [];

        $resource = $this->openFileForReading();

        while (($row = fgetcsv($resource, 0, self::CSV_SEPARATOR)) !== false) {
            $users[] = User::fromCsvRow($row);
        }

        $this->closeFile($resource);

        return $users;
    }

    public function fetchUserByEmail(string $email): ?User
    {
        foreach ($this->fetchUsers() as $user) {
            if ($user->email === $email) {
                return $user;
            }
        }

        return null;
    }

    public function insertUser(User $user): bool
    {
        $resource = $this->openFileForWriting();

        $status = fputcsv($resource, [
                0 => $user->name,
                1 => $user->email,
                2 => PasswordBroker::hashPassword($user->password),
            ], self::CSV_SEPARATOR) !== false;

        $this->closeFile($resource);

        return $status;
    }

    private function closeFile($resource): void
    {
        fclose($resource);
    }

    private function openFileForReading()
    {
        return $this->openFile('r');
    }

    private function openFileForWriting()
    {
        return $this->openFile('a'); // a = writing, end of the file
    }

    private function openFile(string $mode)
    {
        $resource = fopen($this->getFilePath(), $mode);

        if ($resource === false) {
            throw new RuntimeException("Failed to open DB file.");
        }

        return $resource;
    }

    private function getFilePath(): string
    {
        return __DIR__ . '/data/users.db.csv';
    }
}