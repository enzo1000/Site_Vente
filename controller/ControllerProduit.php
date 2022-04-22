<?php

class ControllerProduit
{
    public static function readAll()
    {
        require_once File::build_path(array("model", "ModelProduit.php"));
        $tab_p = ModelProduit::getAllProduits();
        require_once File::build_path(array("view", "all.php"));
    }
}