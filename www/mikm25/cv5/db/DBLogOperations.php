<?php

interface DBLogOperations
{

    /**
     * Logs item inserted
     * @param array<string,int|string|null|bool> $item
     */
    public function logInserted(array $item): void;

    /**
     * Logs item deleted
     * @param array<string,int|string|null|bool> $item
     */
    public function logDeleted(array $item): void;

    /**
     * Logs item updated
     * @param array<string,int|string|null|bool> $item
     * @param array<string,int|string|null|bool> $updateData
     */
    public function logUpdated(array $item, array $updateData): void;

    /**
     * Logs database dumped
     */
    public function logDbDumped(): void;
}