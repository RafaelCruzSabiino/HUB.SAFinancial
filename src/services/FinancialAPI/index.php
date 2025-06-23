<?php

use Hub\Financial\bricks\API\API;
use Hub\Financial\services\FinancialAPI\configurations\Configuration;

require "../../../vendor/autoload.php";
require "configurations/Routes.php";

$uri     = parse_url($_SERVER["REQUEST_URI"])["path"];
$request = $_SERVER["REQUEST_METHOD"];

if(!isset($router[$request]) || !array_key_exists($uri, $router[$request]))
{
    http_response_code(404);
    echo "Rota não encontrada!"; die;
}

$program = new API();
$controller = $router[$request][$uri];

echo json_encode($program->Build($controller, new Configuration()));