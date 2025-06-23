<?php

use Hub\Financial\services\FinancialAPI\configurations\Program;

require "../../../vendor/autoload.php";

if(!isset($router[$_SERVER["REQUEST_METHOD"]]) || !array_key_exists($_GET["route"], $router[$_SERVER["REQUEST_METHOD"]]))
    throw new Exception("A rota não existe", 404);

$controller = $router[$_SERVER["REQUEST_METHOD"]][$_GET["route"]];

echo json_encode(new Program()->Main($controller));