<?php

use third\ArticleBuilder;
use third\BuilderManager;

include_once "BuilderManager.php";
include_once "ArticleBuilder.php";

$creator = new BuilderManager();
$article = new ArticleBuilder([
    'title' => "Горе от ума",
    'body' => "Что-то хочется выпить",

]);
$article2 = new ArticleBuilder([
    'title' => "Проза",
    'body' => "Прощай немытая Россия",

]);

$first = $creator->articleBuilder($article);
$second = $creator->articleBuilder($article2);
$arr = [$first, $second];
var_dump($arr);



