<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE)
        {
            //should not start session if it is already activated by other packages
            throw new SessionException("Session already active.");
        }

        //sessions shouldn't be activated if the data is sent to the browser
        if (headers_sent($fileName, $line))
        {
            //php already sent some data to the browser to be displayed since it sends data in parts (when output buffering not enabled)
            throw new SessionException("Headers already sent. Consider enabling output buffering. Data outputted from {$fileName} - Line: {$line} ");
        }

        //we need to enable the sessions before we can use them 
        session_start();

        $next();

        //close the session after the controller generates the response
        session_write_close();
    }
}
