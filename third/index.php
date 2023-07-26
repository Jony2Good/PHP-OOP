<?php

use third\Builder\ArticleBuilder;
use third\Builder\BuilderManager;
use SimpleStorage\FileStorage;
use SimpleStorage\Article;


include_once "./Builder/BuilderManager.php";
include_once "./Builder/ArticleBuilder.php";
include_once "./Singleton/FileStorage.php";
include_once "./Singleton/Article.php";

$creator = new BuilderManager();
$article = new ArticleBuilder([
    'title' => "Горе от ума",
    'body' => "Что-то хочется выпить",

]);
$article2 = new ArticleBuilder([
    'title' => "Проза",
    'body' => "Прощай немытая Россия",

]);

//$first = $creator->articleBuilder($article);
//$second = $creator->articleBuilder($article2);
//$arr = [$first, $second];
//var_dump($arr);
try{
    $file = FileStorage::getInstance('new_post.txt');
    $file2 = FileStorage::getInstance('article.txt');

    $art1 = new Article($file);
    $art1->title = 'New art';
    $art1->content = 'Content new art';
    $art1->addArticle();


    $art2 = new Article($file2);
    $art1->title = 'Vasiliy Pupkin';
    $art1->content = 'New life in country yard';
    $art1->addArticle();


} catch(\Exception $e) {
    echo $e->getMessage();
}




