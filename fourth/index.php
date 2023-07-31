<?php

use app\Router\Router;

include_once('init.php');

const BASE_URL = '/PHP-OOP/fourth/';
$router = new Router(BASE_URL);

$router->addRoute('', 'ArticlesController');
$router->addRoute('article/1', 'ArticlesController', 'item');
$router->addRoute('article/2', 'ArticlesController', 'item');

$uri = $_SERVER['REQUEST_URI'];
$activeRoute = $router->resolvePath($uri);

$c = $activeRoute['controller'];
$m = $activeRoute['method'];

$c->$m();
$html = $c->render();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple routing</title>
</head>
<body>
<?php echo $html; ?>
Menu
<a href="<?=BASE_URL?>">Home</a>
<a href="<?=BASE_URL?>article/1">Art 1</a>
<a href="<?=BASE_URL?>article/2">Art 2</a>
</body>
</html>
<hr>