<?php

class DBOptions
{

    /**
     * CSV file separator
     * @var string
     */
    private $separator = ';';

    /**
     * Path to CSV file
     * @var string
     */
    private $filePath = '';

    /**
     * CSV file header, mapping of array indexes to model
     * attributes
     * @var array<int,string>
     */
    private $header = [];

    /**
     * Array of default values for specific table
     * @var array<string,int|string|null|bool>
     */
    private $defaultValues = [];

    /**
     * Unique column which will be used in logs to identify handled items
     * @var string
     */
    private $key;

    /**
     * The name of the DB domain to be used in logs, for instance User, Order etc.
     * @var string
     */
    private $domain;

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        if (! file_exists($filePath) || ! is_readable($filePath)) {
            throw new InvalidArgumentException("Database file $filePath does not exist or is not readable!");
        }

        $this->filePath = $filePath;

        return $this;
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function setSeparator(string $separator): self
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * @return array<int,string>
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array<int,string> $header
     */
    public function setHeader(array $header): self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return array<string,int|string|null|bool>
     */
    public function getDefaultValues(): array
    {
        return $this->defaultValues;
    }

    /**
     * @param array<string,int|string|null|bool> $defaultValues
     */
    public function setDefaultValues(array $defaultValues): self
    {
        $this->defaultValues = $defaultValues;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function __toString(): string
    {
        return json_encode([
            'separator' => $this->separator,
            'filePath' => $this->filePath,
            'header' => json_encode($this->header),
            'defaultValues' => json_encode($this->defaultValues),
        ]);
    }
}
