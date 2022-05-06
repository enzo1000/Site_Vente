<?php

class ControllerPanier
{
    public static function get_Panier($idUtilisateur)
    {
        require_once File::build_path(array("model", "ModelPanier.php"));
        ModelPanier::getPanier($idUtilisateur);
        require_once File::build_path(array("view", "panier.php"));
    }

    public static function panier_Panier()
    {
        header("Location:./index.php?controller=ControllerPanier&action=get_Panier");
    }
}