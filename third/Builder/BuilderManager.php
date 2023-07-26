<?php

namespace third\Builder;

require_once "AbstactArticleBuilder.php";

class BuilderManager
{
   public function articleBuilder(AbstactArticleBuilder $builder)
    {
        $builder->setBody();
        $builder->setTitle();
        return $builder->getBuilder();

    }

}