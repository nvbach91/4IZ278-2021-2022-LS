<?php

namespace App\Models\Attributes;

use InvalidArgumentException;

class CompanySizeAttribute
{
    public const SIZE_TO_50 = 'to_50',
        SIZE_50_TO_100 = '50_to_100',
        SIZE_100_TO_200 = '100_to_200',
        SIZE_200_UPPER = '200_upper';

    /**
     * @var string
     */
    private $size;

    private function __construct(string $size)
    {
        $this->size = $size;
    }

    public static function of(string $size): self
    {
        if (! array_key_exists($size, self::getAllSizes())) {
            throw new InvalidArgumentException("Undefined company size $size given.");
        }

        return new self($size);
    }

    /**
     * @return array<string,CompanySizeAttribute>
     */
    public static function getAllSizes(): array
    {
        return [
            self::SIZE_TO_50 => new self(self::SIZE_TO_50),
            self::SIZE_50_TO_100 => new self(self::SIZE_50_TO_100),
            self::SIZE_100_TO_200 => new self(self::SIZE_100_TO_200),
            self::SIZE_200_UPPER => new self(self::SIZE_200_UPPER),
        ];
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getTranslatedSize(): string
    {
        /** @var string $translated */
        $translated = __("companies.sizes.$this->size");

        return $translated;
    }
}
