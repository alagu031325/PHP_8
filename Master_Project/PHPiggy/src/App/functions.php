<?php

declare(strict_types=1);

use Framework\Http;

function dd(mixed $value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function escape(mixed $value)
{
    return htmlspecialchars((string) $value);
}

function redirectTo(string $path)
{
    header("Location: {$path}");
    //temporary redirection
    http_response_code(Http::REDIRECT_STATUS_CODE);
    exit;
}
