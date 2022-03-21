<?php

class FileHandler
{

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var resource|null
     */
    public $resource = null;

    private function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public static function fromPath(string $filePath): self
    {
        return new self($filePath);
    }

    public function read(): void
    {
        $this->open('r');
    }

    public function write(): void
    {
        $this->open('a');
    }

    public function close(): void
    {
        if ($this->resource === null) {
            throw new RuntimeException("Cannot close empty resource for path $this->filePath!");
        }

        fclose($this->resource);
    }

    /**
     * Clears the contents of the file
     */
    public function clear(): void
    {
        $this->open('w');
        $this->close();
    }

    public function open(string $mode)
    {
        $this->resource = fopen($this->filePath, $mode);

        if ($this->resource === false) {
            throw new RuntimeException("Failed to open file $this->filePath!");
        }
    }
}