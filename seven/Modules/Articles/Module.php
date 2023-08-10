<?php

namespace Modules\Articles;

use System\Contracts\IModule;
use System\Contracts\IRouter;
use Modules\Articles\Controllers\Index as C;

class Module implements IModule{
	public function registerRoutes(IRouter $router) : void {
		$i = '[1-9]+\d*';
		$map = [ 1 => 'id' ];
		$router->addRoute('/^$/', C::class);
		$router->addRoute("/^article\/($i)$/", C::class, 'item', $map);
		$router->addRoute('/^article\/add$/', C::class, 'add');
		$router->addRoute("/^article\/delete\/($i)$/", C::class, 'remove', $map);
		$router->addRoute("/^article\/edit\/($i)$/", C::class, 'edit', $map);
	}
}