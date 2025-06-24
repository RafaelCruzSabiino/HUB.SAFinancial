<?php

header('Content-Type: application/json');

use Hub\Financial\bricks\API\API;
use Hub\Financial\services\FinancialAPI\configurations\Configuration;

require "../../../vendor/autoload.php";
$routes = include __DIR__ . "/configurations/Routes.php";

$program = new API();

echo json_encode($program->RunApp($routes, new Configuration()));