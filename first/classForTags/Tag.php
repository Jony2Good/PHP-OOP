<?php

namespace first;

class Tag
{
    public string $name;
    protected array $attr = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

    }

    /**
     * @param string $src
     * @param string $text
     * @return array
     */
    public function attr(string $src, string $text)
    {
        $this->attr[$src] = $text;
        return $this->attr;
    }

    public function render(): string
    {
        return '';
    }

    protected function createAttrString(): string
    {
        $arr = [];
        foreach ($this->attr as $name => $value) {
            $arr[] = "$name=\"$value\"";
        }
        return implode(' ', $arr);
    }
}





