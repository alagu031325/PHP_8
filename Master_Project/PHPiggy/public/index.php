<?php

declare(strict_types=1);

//functions cant be autoloaded with psr 4 standard
include __DIR__ . '/../src/App/functions.php';

$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->run();
