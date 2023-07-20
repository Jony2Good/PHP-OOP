<?php

namespace first;

include_once "./Tag.php";

class PairTag extends Tag
{
    protected array $children = [];

    public function appendChild(Tag $child): array
    {
        $this->children[] = $child;
        return $this->children;
    }

    public function render($class = null): string
    {
        $attrsStr = $this->createAttrString();
        $childrenHTML = array_map(function (Tag $tag) {
            return $tag->render();
        }, $this->children);
        $innerHTML = implode('', $childrenHTML);
        return "<{$this->name} $class $attrsStr>$innerHTML</{$this->name}>";
    }

}