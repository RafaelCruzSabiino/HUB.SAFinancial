<?php

use Hub\Financial\bricks\API\config\RouteSettings;

return  [
          #region "Rotas GET"
          "GET" =>  [
                      "/consultar" => new RouteSettings("FinancialAPI", "FinancialController", "Consultar")
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