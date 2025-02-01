<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    //enforcing the structure of an array with function
    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        //single route need a few pieces of information
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        //remove the "/" char if it exists - readd it - this is to ensure all paths are consistents eg. about/ -> /about/ 
        $path = trim($path, "/");
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route)
        {
            //if we pass plain value the pattern is an exact match 
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            )
            {
                continue;
            }

            [$class, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($class) : new $class;
            $action = fn() => $controllerInstance->{$function}();

            foreach ($this->middlewares as $middleware)
            {
                $middlewareInstance = $container ?
                    $container->resolve($middleware) :
                    new $middleware;
                //our middleware either expects next middleware to be passed on or the action to be executed next
                $action = fn() => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
        //array_unshift($this->middlewares, $middleware);
    }
}
