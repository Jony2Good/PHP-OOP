<?php
var_dump($_SERVER['DOCUMENT_ROOT']);

include_once('init.php');

use app\Router\Router;
use app\Controller\Controller as AC;

const BASE_URL = '/PHP-OOP/fourth/';
$router = new Router(BASE_URL);

$router->addRoute('', AC::class);
$router->addRoute('article/1', AC::class, 'item');
$router->addRoute('article/2', AC::class, 'item');

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