<?php

use Hub\Financial\bricks\API\API;
use Hub\Financial\services\FinancialAPI\configurations\Configuration;

require "../../../vendor/autoload.php";
$routes = include __DIR__ . "/configurations/Routes.php";

$program = new API();
$settings = $program->GetSettings($routes);

echo json_encode($program->Build($settings, new Configuration()));