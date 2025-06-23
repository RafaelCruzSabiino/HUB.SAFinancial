<?php

use Hub\Financial\services\FinancialAPI\Program;

require "../../../vendor/autoload.php";

$controller = $router[$_SERVER["REQUEST_METHOD"]][$_GET["route"]];

$program = new Program();

echo json_encode($program->Main($controller));