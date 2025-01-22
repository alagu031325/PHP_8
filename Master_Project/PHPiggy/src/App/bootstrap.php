<?php

declare(strict_types=1);

//contains code that configures the project and loads other files 

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;

$app = new App();

return $app;