<?php

use Hub\Financial\services\FinancialAPI\Program;

require "../../../vendor/autoload.php";
require "configurations/Routes.php";

$uri     = parse_url($_SERVER["REQUEST_URI"])["path"];
$request = $_SERVER["REQUEST_METHOD"];

if(!isset($router[$request]) || !array_key_exists($uri, $router[$request]))
{
    http_response_code(404);
    echo "Rota não encontrada!"; die;
}

$program = new Program();
$controller = $router[$request][$uri];

echo json_encode($program->Main($controller));