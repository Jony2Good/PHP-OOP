<?php

namespace third\Builder;

abstract class AbstactArticleBuilder
{
    public array $storage = [];
    abstract function setTitle();

    abstract function setBody();


    abstract function getStorage();


    abstract function getBuilder();
}