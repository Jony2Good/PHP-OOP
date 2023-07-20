<?php

namespace second;

require_once './Storage.php';
require_once './ISession.php';

class SessionStorage extends Storage implements ISession
{
    /**
     * @return void
     */
    public static function start(): void
    {
        session_start();
    }

    /**
     * @return void
     */
    public static function end(): void
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function add(string $key, mixed $data): void
    {
        $_SESSION[] = [$this->setKey($key) => $this->setData($data)];
    }

    /**
     * @param string $key
     * @return void
     */
    public function remove(string $key): void
    {
        foreach ($_SESSION as $item => $value) {
            if (array_key_exists($key, $value)) {
                unset($_SESSION[$item]);
            }
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function contains(string $key): bool
    {
        foreach ($_SESSION as $item) {
            if (array_key_exists($key, $item)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): array
    {
        $data = [];
        if ($this->contains($key)) {
            foreach ($_SESSION as $item) {
                if (isset($item[$key])) {
                    $data[] = $item[$key];
                }
            }
        }
        return $data;
    }
}




