<?php

// On recupère l'action passée dans l'URL et un paramètre optionnel
include_once File::build_path(array("controller", "ControllerProduit.php"));

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];

    include_once File::build_path(array("controller", "$controller.php"));

    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if (isset($_GET['param'])) {
            $param = $_GET['param'];
            $controller::$action($param);
        } else
            $controller::$action();
    }
    else
        ControllerProduit::home();
} else
    ControllerProduit::home();