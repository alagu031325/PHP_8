<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $validHttpMethods = ['POST', 'PATCH', 'DELETE'];

        if (!in_array($requestMethod, $validHttpMethods))
        {
            $next();
            return;
        }

        //proceed to validate Token
        if ($_SESSION['token'] !== $_POST['token'])
        {
            redirectTo('/');
        }

        //Token valid - delete the used token - reusing tokens can cause security issues
        unset($_SESSION['token']);
        $next();
    }
}
