<?php

namespace first;

include_once "./Tag.php";

class SingleTag extends Tag
{
    public function render(): string
    {
        $attrsStr = $this->createAttrString();
        return "<{$this->name} $attrsStr>";
    }
}