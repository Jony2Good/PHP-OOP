<?php

namespace Modules\Articles;

use System\Contracts\IModule;
use System\Contracts\IRouter;
use Modules\Articles\Controllers\Index as C;

class Module implements IModule{
	public function registerRoutes(IRouter $router) : void {
		$router->addRoute('', C::class);
		$router->addRoute('article/1', C::class, 'item');
		$router->addRoute('article/2', C::class, 'item');
		$router->addRoute('article/add', C::class, 'add');
	}
}