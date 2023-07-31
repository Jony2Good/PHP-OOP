<?php

namespace app\Router;

use app\Controller\ArticlesController;

class Router
{
    protected string $baseUrl;
    protected int $baseShift;
    protected array $routes = [];

    public function __construct(string $baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
        $this->baseShift = strlen($this->baseUrl);

    }

    public function addRoute(string $url, string $contorllerName, string $contorllerMethod = 'index')
    {
        $this->routes[] = [
            'path' => $url,
            'c' => $contorllerName,
            'm' => $contorllerMethod
        ];
    }

    public function resolvePath(string $url): array
    {
        $relativeUrl = substr($url, $this->baseShift);
        $route = $this->findPath($relativeUrl);
        $params = explode('/', $relativeUrl);
//        $controller = new $route['c']();
        $controller = new ArticlesController();
        $controller->setEnvironment($params);
        return [
            'controller' => $controller,
            'method' => $route['m']
        ];
    }

    protected function findPath(string $url): ?array
    {
        $activeRoute = null;

        foreach ($this->routes as $route) {
            if ($url === $route['path']) {
                $activeRoute = $route;
            }
        }

        return $activeRoute;
    }
}