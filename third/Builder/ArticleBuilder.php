<?php

namespace third\Builder;

require_once "Article.php";

class ArticleBuilder extends AbstactArticleBuilder
{
    private object $instance;

    public function __construct(array $options)
    {
        $this->storage = $options;
        $this->instance = new Article();
    }

    function setTitle()
    {
        $this->instance->title = $this->storage['title'];
    }

    function setBody()
    {
        $this->instance->body = $this->storage['body'];
    }

    public function getStorage(): array
    {
        return $this->storage;
    }

    public function getBuilder(): object
    {
        return $this->instance;
    }
}