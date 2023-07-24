<?php

namespace third;

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