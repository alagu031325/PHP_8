<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class CsrfTokenMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view)
    {
    }

    public function process(callable $next)
    {
        //binary data returned - cant be displayed on browser - so converting binary to hex
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));

        $this->view->addGlobal('csrfToken', $_SESSION['token']);

        $next();
    }
}
