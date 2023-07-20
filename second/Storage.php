<?php

namespace second;

require_once './IStorage.php';

class Storage implements IStorage
{
    protected array $boxMemory;
    private mixed $key;
    private mixed $data;


    public function getBox(): array
    {
        return $this->boxMemory;
    }

    public function getKey(): mixed
    {
        return $this->key;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setKey(string $key): string
    {
        return $this->key = $key;
    }

    public function setData(mixed $data): mixed
    {
        return $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function add(string $key, mixed $data): void
    {
        $this->boxMemory[] = [$this->setKey($key) => $this->setData($data)];
    }

    /**
     * @param string $key
     * @return void
     */
    public function remove(string $key): void
    {
        foreach ($this->boxMemory as $item => $value) {
            if (array_key_exists($key, $value)) {
                unset($this->boxMemory[$item]);
            }
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function contains(string $key): bool
    {
        foreach ($this->boxMemory as $item) {
           if(array_key_exists($key, $item)) {
               return true;
           }
        }
        return false;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        $data = [];
        if ($this->contains($key)) {
            foreach ($this->boxMemory as $item) {
                if (isset($item[$key])) {
                    $data[] = $item[$key];
                }
            }
        }
        return $data;
    }
}








