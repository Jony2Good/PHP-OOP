<?php

const DB_HOST = 'localhost';
const DB_NAME = 'message';
const DB_USER = 'root';
const DB_PASS = '';

include_once('DBHelper.php');
include_once('SelectBuilder.php');
include_once('QuerySelect.php');


function niceDump($any){
	echo '<pre>';
	var_dump($any);
	echo '</pre>';
} 

$minId = $_GET['min'] ?? 0;
$qs = new QuerySelect('messages');
$qs->where("dt_add > '2021-03-01'")->limit('3')();

if(mt_rand(1, 2) > 1){
	$qs->where('AND id_message > :min', ['min' => $minId]);
}

$res = $qs();
niceDump($res);