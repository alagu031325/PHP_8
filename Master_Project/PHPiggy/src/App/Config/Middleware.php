<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{
    TemplateDataMiddleware,
    ValidationExceptionMiddleware,
    SessionMiddleware,
    FlashMiddleware,
    CsrfTokenMiddleware,
    CsrfGuardMiddleware
};

function registerMiddleware(App $app)
{
    //order of registration matters - only if session is enabled by session middleware then csrf can store token in session
    $app->addMiddleware(CsrfGuardMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    //Middleware registered last is executed first
    $app->addMiddleware(SessionMiddleware::class);
}
