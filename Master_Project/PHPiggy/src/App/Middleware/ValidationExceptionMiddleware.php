<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try
        {
            $next();
        }
        catch (ValidationException $e)
        {
            //redirection is a separate request so the form data submitted by previous request is lost - so we use sessions
            $_SESSION['errors'] = $e->errors;

            $oldFormData = $_POST;
            $excludedFields = ['password', 'confirmPassword'];
            //if both arrays have similar keys - then array_diff_key method will exclude them and merge both into single array 
            //array_flip flips the keys and values so 'password' becomes the key
            $formattedFormData = array_diff_key($oldFormData, array_flip($excludedFields));

            $_SESSION['oldFormData'] = $formattedFormData;
            $referer = $_SERVER['HTTP_REFERER'];
            //catch errors thrown by validation middlewares
            redirectTo($referer);
        }
    }
}
