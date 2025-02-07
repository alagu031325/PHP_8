<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RunTimeException;

class ValidationException extends RunTimeException
{
    //custom exception can be useful to transfer information between classes
    //errors transferred from Validator to ValidationExceptionMiddleware
    public function __construct(public array $errors, int $statusCode = 422)
    {
        parent::__construct(code: $statusCode);
    }
}
