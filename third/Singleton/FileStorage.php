<?php

namespace SimpleStorage;

include_once "StorageInterface.php";

class FileStorage implements StorageInterface
{
    protected static $instance;
    protected array $records = [];

    protected int $ai = 0;
    protected string $filePath;

    protected function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
            $this->records = $data['records'];
            $this->ai = $data['id'];
        }
    }

    /**
     * @param string $filePath
     * @return static
     */
    public static function getInstance(string $filePath): static
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($filePath);
        }
        return static::$instance;
    }

    /**
     * @param array $fields
     * @return int
     */
    public function create(array $fields): int
    {
        $id = ++$this->ai;
        $this->records[$id] = $fields;
        $this->save();
        return $id;
    }

    protected function save()
    {
        file_put_contents($this->filePath, json_encode([
            'id' => $this->ai,
            'records' => $this->records,
        ]));
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        return $this->records[$id] ?? null;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): bool
    {
        if (array_key_exists($id, $this->records)) {
            unset($this->records[$id]);
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * @param array $fields
     * @return bool
     */
    public function update(int $id, array $fields): bool
    {
        if (array_key_exists($id, $this->records)) {
            $this->records[$id] = $fields;
            $this->save();
            return true;
        }
        return false;
    }
}