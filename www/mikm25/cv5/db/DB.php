<?php

require_once __DIR__ . '/../models/FileHandler.php';
require_once __DIR__ . '/DBOperations.php';
require_once __DIR__ . '/DBOptions.php';
require_once __DIR__ . '/DBLogOperations.php';
require_once __DIR__ . '/DBLog.php';

abstract class DB implements DBOperations, DBLogOperations
{

    /**
     * @var DBOptions
     */
    protected $options;

    /**
     * @var list<DBLog>
     */
    protected $logs = [];

    public function __construct()
    {
        $this->options = $this->getOptions();
    }

    /**
     * @inheritdoc
     */
    public function create(array $data, bool $log = true): bool
    {
        return $this->insert([$data], $log);
    }

    /**
     * @inheritdoc
     */
    public function createMany(array $data, bool $log = true): bool
    {
        return $this->insert($data, $log);
    }

    /**
     * Inserts multiple rows into the DB
     * @param list<array<string,int|string|null|bool>> $dataSets
     * @return bool if the data were successfully inserted
     */
    private function insert(array $dataSets, bool $log = true): bool
    {
        $dataSets = array_map(function (array $data): array {
            // merge data with default values
            $data = array_merge($this->options->getDefaultValues(), $data);

            // check if there are all attributes we need to insert data
            $missingAttributes = array_diff($this->options->getHeader(), array_keys($data));

            if (count($missingAttributes) > 0) {
                throw new InvalidArgumentException(sprintf(
                    "Cannot insert row! Invalid attributes supplied for %s. Missing attributes: [%s].",
                    __METHOD__,
                    implode(', ', $missingAttributes),
                ));
            }

            $mappedData = [];

            // map attributes to integer indexes
            foreach ($this->options->getHeader() as $index => $attribute) {
                $mappedData[$index] = $data[$attribute];
            }

            // return mapped data and raw data together
            // because we need both
            // raw data => log
            // mapped data => insert
            return [$data, $mappedData];
        }, $dataSets);

        $file = FileHandler::fromPath($this->options->getFilePath());
        $file->write();

        $status = true;

        foreach ($dataSets as $data) {
            if (fputcsv($file->resource, $data[1], $this->options->getSeparator()) === false) {
                $status = false;
            } elseif ($log) {
                $this->logInserted($data[0]);
            }
        }

        $file->close();

        return $status;
    }

    public function logInserted(array $item): void
    {
        $key = $this->options->getKey();
        $value = $item[$key] ?? '–';

        $this->logs[] = DBLog::create("{$this->options->getDomain()} with $key = $value inserted.");
    }

    /**
     * @inheritdoc
     */
    public function fetchOne(array $condition = []): ?array
    {
        // validate condition attributes
        $unknownAttributes = array_diff(array_keys($condition), $this->options->getHeader());

        if (count($unknownAttributes) > 0) {
            throw new InvalidArgumentException(sprintf(
                "Cannot use unknown attributes in condition! Invalid attributes supplied for %s. Unknown attributes: [%s].",
                __METHOD__,
                implode(', ', $unknownAttributes),
            ));
        }

        foreach ($this->fetchAll() as $item) {
            foreach ($condition as $attribute => $value) {
                if (! array_key_exists($attribute, $item) || $item[$attribute] !== $value) {
                    continue 2;
                }
            }

            return $item;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function fetch(array $condition = []): array
    {
        // validate condition attributes
        $unknownAttributes = array_diff(array_keys($condition), $this->options->getHeader());

        if (count($unknownAttributes) > 0) {
            throw new InvalidArgumentException(sprintf(
                "Cannot use unknown attributes in condition! Invalid attributes supplied for %s. Unknown attributes: [%s].",
                __METHOD__,
                implode(', ', $unknownAttributes),
            ));
        }

        $items = [];

        foreach ($this->fetchAll() as $item) {
            foreach ($condition as $attribute => $value) {
                if (! array_key_exists($attribute, $item) || $item[$attribute] !== $value) {
                    continue 2;
                }
            }

            $items[] = $item;
        }

        return $items;
    }

    public function fetchAll(): array
    {
        $rows = [];

        $file = FileHandler::fromPath($this->options->getFilePath());
        $file->read();

        while (($row = fgetcsv($file->resource, 0, $this->options->getSeparator())) !== false) {
            $mappedRow = [];

            foreach ($this->options->getHeader() as $index => $attribute) {
                $mappedRow[$attribute] = $row[$index];
            }

            $rows[] = $mappedRow;
        }

        $file->close();

        return $rows;
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, array $condition = [], bool $log = true): bool
    {
        // validate attributes
        $unknownAttributes = array_diff(array_keys($data), $this->options->getHeader());

        if (count($unknownAttributes) > 0) {
            throw new InvalidArgumentException(sprintf(
                "Cannot update unknown attributes! Invalid attributes supplied for %s. Unknown attributes: [%s].",
                __METHOD__,
                implode(', ', $unknownAttributes),
            ));
        }

        // validate condition attributes
        $unknownAttributes = array_diff(array_keys($condition), $this->options->getHeader());

        if (count($unknownAttributes) > 0) {
            throw new InvalidArgumentException(sprintf(
                "Cannot use unknown attributes in condition! Invalid attributes supplied for %s. Unknown attributes: [%s].",
                __METHOD__,
                implode(', ', $unknownAttributes),
            ));
        }

        // update all items from DB with given data
        $items = array_map(function (array $item) use ($data, $condition, $log): array {
            foreach ($condition as $attribute => $value) {
                if (! array_key_exists($attribute, $item) || $item[$attribute] !== $value) {
                    return $item;
                }
            }

            $item = array_merge($item, $data);

            if ($log) {
                $this->logUpdated($item, $data);
            }

            return $item;
        }, $this->fetchAll());

        // dump whole DB and insert items again
        // TODO kinda dumb, could be better
        return $this->dump(false) && $this->createMany($items, false);
    }

    public function logUpdated(array $item, array $updateData): void
    {
        $key = $this->options->getKey();
        $value = $item[$key] ?? '–';

        $data = json_encode($updateData);

        $this->logs[] = DBLog::create("{$this->options->getDomain()} with $key = $value updated with data: $data.");
    }

    /**
     * @inheritdoc
     */
    public function delete(array $condition = [], bool $log = true): bool
    {
        // validate condition attributes
        $unknownAttributes = array_diff(array_keys($condition), $this->options->getHeader());

        if (count($unknownAttributes) > 0) {
            throw new InvalidArgumentException(sprintf(
                "Cannot use unknown attributes in condition! Invalid attributes supplied for %s. Unknown attributes: [%s].",
                __METHOD__,
                implode(', ', $unknownAttributes),
            ));
        }

        // filter all data by given condition
        $items = array_filter($this->fetchAll(), function (array $item) use ($condition, $log): bool {
            foreach ($condition as $attribute => $value) {
                if (! array_key_exists($attribute, $item) || $item[$attribute] !== $value) {
                    return true;
                }
            }

            if ($log) {
                $this->logDeleted($item);
            }

            return false;
        });

        // dump whole DB and insert items again
        // TODO kinda dumb, could be better
        return $this->dump(false) && $this->createMany($items, false);
    }

    public function logDeleted(array $item): void
    {
        $key = $this->options->getKey();
        $value = $item[$key] ?? '–';

        $this->logs[] = DBLog::create("{$this->options->getDomain()} with $key = $value deleted.");
    }

    /**
     * @inheritdoc
     */
    public function dump(bool $log = true): bool
    {
        FileHandler::fromPath($this->options->getFilePath())->clear();

        if ($log) {
            $this->logDbDumped();
        }

        return true;
    }

    public function logDbDumped(): void
    {
        $this->logs[] = DBLog::create("{$this->options->getDomain()} table dumped.");
    }

    /**
     * @return list<DBLog>
     */
    public function dumpLogs(): array
    {
        return array_map(static function (DBLog $log): string {
            return (string) $log;
        }, $this->logs);
    }

    public function __toString(): string
    {
        $class = static::class;

        return "$class: $this->options";
    }

    abstract protected function getOptions(): DBOptions;
}
