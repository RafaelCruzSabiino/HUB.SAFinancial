<?php

use Hub\Financial\bricks\API\config\RouteSettings;

$body = json_decode(file_get_contents('php://input'), true);

return  [
          #region "Rotas GET"
          "GET" =>  [
                      "/consultar" => new RouteSettings("FinancialAPI", "FinancialController", "Consultar", [$body])
                    ],
          #endregion

          #regino "Rotas POST"
          "POST" => [],
          #endregion

          #region "Rodas PUT"
          "PUT" =>  [],
          #endregion
          
          #region "Rodas DELETE"
          "DELETE" => [],
          #endregion
        ];