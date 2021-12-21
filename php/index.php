<?php

require_once('./route/route.php');

class FontController
{
    public static function proc()
    {
        $ret = Router::proc();

        $filename = $ret['fileName'] . "/" . $ret['fileName'] . ".php";
        $controllerName = $ret['controllerName'];

        require_once($filename);
        echo json_encode($controllerName(), JSON_UNESCAPED_UNICODE);
    }
}

FontController::proc();
