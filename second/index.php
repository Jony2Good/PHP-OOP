<?php

namespace second;

require_once "./Storage.php";
require_once "./SessionStorage.php";

$a = new Storage();
$a->add('surname', 'Filipov');
$a->add('name', 'Nikita');
$a->add('name', 'Mary');

$a->remove('name');

var_dump($a->getBox());

$b = new SessionStorage();
$b->add('name', 'Johnny');
$b->add('city', 'Moscow');
$b->add('token', password_hash(rand(5,100), PASSWORD_BCRYPT));
$b->add('name', 'Zloy Hach');
$b->add('city', 'Tula');
$b->add('token', password_hash(rand(5,100), PASSWORD_BCRYPT));

$b->remove('city');

var_dump($_SESSION);
