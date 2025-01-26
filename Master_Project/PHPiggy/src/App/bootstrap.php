<?php

declare(strict_types=1);

//contains code that configures the project and loads other files 

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
//composer doesnt autoload this function automatically so add to the composer.json file
use function App\Config\{registerRoutes, registerMiddleware};

use App\Config\Paths;

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

return $app;
