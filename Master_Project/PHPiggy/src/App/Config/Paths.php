<?php

declare(strict_types=1);

namespace App\Config;

class Paths
{
    //constants can also be autoloaded with the composer if defined within class
    public const VIEW = __DIR__ . "/../views";
    public const SOURCE = __DIR__ . "/../../";
    public const ROOT = __DIR__ . "/../../../";
}
