<?php

include_once File::build_path(array("controller", "ControllerProduit.php"));

// On recupère l'action passée dans l'URL
//$action = $_GET['action'];

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    ControllerProduit::$action();
}