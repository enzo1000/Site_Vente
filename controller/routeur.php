<?php

include_once File::build_path(array("controller", "ControllerProduit.php"));

// On recupère l'action passée dans l'URL et un paramètre optionnel

 if(isset($_GET['action'])) {
    $action = $_GET['action'];

    if (isset($_GET['param'])) {
        $param = $_GET['param'];
        ControllerProduit::$action($param);
    }
    else
        ControllerProduit::$action();
} else
    ControllerProduit::home();