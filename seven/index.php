<?php

/* echo password_hash('12345', PASSWORD_BCRYPT) . '<br>';
echo password_verify('12345', '$2y$10$JvXEzIH4eXtYeWDOTG4GdeE8MKKwzCWnajCraqui1YybbntMti5Ju') . '<br>';
 */
include_once('init.php');
include_once('vendor/autoload.php');

use System\Exceptions\Exc404;
use System\Router;
use System\ModulesDispatcher;

use Modules\Articles\Module as Articles;
use Modules\Users\Module as Users;
use System\Template;

const BASE_URL = '/php-oop/l8/';
const DB_HOST = 'localhost';
const DB_NAME = 'oop';
const DB_USER = 'root';
const DB_PASS = '';

try{	
	Template::getInstance()->addGlobalVar('baseUrl', BASE_URL);

	$modules = new ModulesDispatcher();
	$modules->add(new Articles());
	$modules->add(new Users());
	$router = new Router(BASE_URL);

	$modules->registerRoutes($router);
/* 	 */

	$uri = $_SERVER['REQUEST_URI'];
	$activeRoute = $router->resolvePath($uri);

	$c = $activeRoute['controller'];
	$m = $activeRoute['method'];

	$c->$m();
	$html = $c->render();
	echo $html;
}
catch(Exc404 $e){
	echo '404'; 
}
catch(Throwable $e){
	echo 'nice show error - ' . $e->getMessage();
}