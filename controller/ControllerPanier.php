<?php

class ControllerPanier
{
    public static function get_Panier($idUtilisateur)
    {
        require_once File::build_path(array("model", "ModelPanier.php"));
        ModelPanier::getPanier($idUtilisateur);
        require_once File::build_path(array("view", "lignePanier.php"));
    }

    public static function creer_Panier()
    {
        require_once File::build_path(array("model", "ModelPanier.php"));
        ModelPanier::creerPanier();
    }

    public static function delete_Panier()
    {
        require_once File::build_path(array("model", "ModelPanier.php"));
        ModelPanier::deletePanier();
        header("Location:index.php");
    }
}