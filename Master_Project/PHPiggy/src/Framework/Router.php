<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private array $errorHandler;

    //enforcing the structure of an array with function
    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);

        $regexPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);

        //single route need a few pieces of information
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
            'middlewares' => [],
            'regexPath' => $regexPath
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
        $method = strtoupper($_POST['_METHOD'] ?? $method);

        foreach ($this->routes as $route)
        {
            //if we pass plain value the pattern is an exact match 
            if (
                //Param values holds all the matches 
                !preg_match("#^{$route['regexPath']}$#", $path, $paramValues) ||
                $route['method'] !== $method
            )
            {
                continue;
            }

            //The full path will always be the first item in the array so we are shifting to remove it
            array_shift($paramValues);

            preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);
            $paramKeys = $paramKeys[1];
            $params = array_combine($paramKeys, $paramValues);

            [$class, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($class) : new $class;
            $action = fn() => $controllerInstance->{$function}($params);

            //we are applying global middlewares to the last - middlewares to the last are executed first
            $allMiddleware = [...$route['middlewares'], ...$this->middlewares];
            foreach ($allMiddleware as $middleware)
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

        $this->dispatchNotFound($container);
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    //we shouldnt accept instances - because if a middleware is not called then instance remain unused
    public function addRouteMiddleware(string $middleware)
    {
        //adding middleware to last route registered 
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middlewares'][] = $middleware;
    }

    public function setErrorHandler(array $controller)
    {
        $this->errorHandler = $controller;
    }

    public function dispatchNotFound(?Container $container)
    {
        [$class, $function] = $this->errorHandler;
        $controllerInstance = $container ? $container->resolve($class) : new $class;
        $action = fn() => $controllerInstance->$function();

        foreach ($this->middlewares as $middleware)
        {
            $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
            $action = fn() => $middlewareInstance->process($action);
        }

        $action();
    }
}
