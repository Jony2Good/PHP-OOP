<?php

use first\PairTag;
use first\SingleTag;

include_once "./SingleTag.php";
include_once "./PairTag.php";

function createTags($class = null): void
{
    $img = new SingleTag('img');
    $img->attr('src', __DIR__ . '\img\about-goal.png');
    $img->attr('alt', 'f1 not found');
    $label = new PairTag('div');
    $label->appendChild($img);

    $html = $label->render($class);
    echo $html;
    echo '<hr>' . htmlspecialchars($html);
}

createTags("style ='width: 100%;'");

