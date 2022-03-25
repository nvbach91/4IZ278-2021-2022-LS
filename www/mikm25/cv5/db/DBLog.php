<?php

class DBLog
{

    /**
     * @var string
     */
    private $message;

    /**
     * @var int unix timestamp
     */
    private $timestamp;

    private function __construct(string $message, int $timestamp)
    {
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public static function create(string $message): self
    {
        return new self($message, (new DateTimeImmutable('now', new DateTimeZone('UTC')))->getTimestamp());
    }

    public function __toString(): string
    {
        return "$this->timestamp: $this->message";
    }
}