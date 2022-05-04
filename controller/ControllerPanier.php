<?php

class ControllerPanier
{
    public static function get_Panier($idUtilisateur)
    {
        require_once File::build_path(array("model", "ModelPanier.php"));
        ModelPanier::getPanier($idUtilisateur);
    }

    public static function test()
    {
        header("Location:./view/panier.php");
    }
}