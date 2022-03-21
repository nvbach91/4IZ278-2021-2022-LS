<?php

interface DBOperations
{

    /**
     * Creates new row in the DB
     * @param array<string|int,int|string|null|bool> $data key-value pairs of data to be inserted
     * @return bool if the data were successfully inserted
     */
    public function create(array $data, bool $log = true): bool;

    /**
     * Creates many rows in the DB
     * @param list<array<string|int,int|string|null|bool>> $data list of key-value pairs of data to be inserted
     * @return bool if all the data were successfully inserted
     */
    public function createMany(array $data, bool $log = true): bool;

    /**
     * Fetches one row from the DB by given condition,
     * empty condition means it will return the first row
     * @param array<string|int,int|string|null|bool> $condition
     * @return array|null array if row was found, null otherwise
     */
    public function fetchOne(array $condition = []): ?array;

    /**
     * Fetches rows from the DB by given condition,
     * empty condition means it will return all rows
     * @param array<string|int,int|string|null|bool> $condition
     * @return array list of items found, empty array means nothing was found
     */
    public function fetch(array $condition = []): array;

    /**
     * Fetches all items from the CSV file
     */
    public function fetchAll(): array;

    /**
     * @param array<string|int,int|string|null|bool> $data key-value pairs of data
     * to be updated
     * @param array<string|int,int|string|null|bool> $condition key-value pairs which
     * tells us which row to update, empty array means everything
     * @return bool if the operation was successful or not
     */
    public function update(array $data, array $condition = [], bool $log = true): bool;

    /**
     * @param array<string|int,int|string|null|bool> $condition
     * @return bool if the operation was successful or not
     */
    public function delete(array $condition = [], bool $log = true): bool;

    /**
     * Dumps whole DB
     * @return bool of the operation was successful
     */
    public function dump(bool $log = true): bool;
}
