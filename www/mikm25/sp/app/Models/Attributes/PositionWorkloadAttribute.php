<?php

namespace App\Models\Attributes;

use InvalidArgumentException;

class PositionWorkloadAttribute
{
    public const FULL_TIME = 'full_time',
        PART_TIME = 'part_time',
        CONTRACT = 'contract',
        FREELANCE = 'freelance',
        INTERNSHIP = 'internship',
        ON_SITE = 'on_site',
        REMOTE = 'remote';

    /**
     * @var string
     */
    private $workload;

    private function __construct(string $workload)
    {
        $this->workload = $workload;
    }

    public static function of(string $workload): self
    {
        if (! array_key_exists($workload, self::getAllWorkloads())) {
            throw new InvalidArgumentException("Undefined position workload $workload given.");
        }

        return new self($workload);
    }

    /**
     * @return array<string,PositionWorkloadAttribute>
     */
    public static function getAllWorkloads(): array
    {
        return [
            self::FULL_TIME => new self(self::FULL_TIME),
            self::PART_TIME => new self(self::PART_TIME),
            self::CONTRACT => new self(self::CONTRACT),
            self::FREELANCE => new self(self::FREELANCE),
            self::INTERNSHIP => new self(self::INTERNSHIP),
            self::ON_SITE => new self(self::ON_SITE),
            self::REMOTE => new self(self::REMOTE),
        ];
    }

    public function getWorkload(): string
    {
        return $this->workload;
    }

    public function getTranslatedWorkload(): string
    {
        /** @var string $translated */
        $translated = __("positions.workloads.$this->workload");

        return $translated;
    }
}
