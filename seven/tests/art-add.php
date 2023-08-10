<?php

const BASE_URL = '/php-oop/l7/';
const DB_HOST = 'localhost';
const DB_NAME = 'oop';
const DB_USER = 'root';
const DB_PASS = '';

spl_autoload_register(function($name){
	$path = '../' . str_replace('\\', '/', $name) . '.php';

	if(file_exists($path)){
		include_once($path);
	}
});

use Modules\Articles\Controllers\Index as Control;

$c = new Control();
$c->setEnviroment([], [], ['title' => '1', 'content' => '2'], ['REQUEST_METHOD' => 'POST']);
$c->add();
$res = $c->render();
echo $res;