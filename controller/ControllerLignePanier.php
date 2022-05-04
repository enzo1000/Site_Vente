<?php


class ControllerLignePanier
{
    public static function readAll_LignePanier($idPanier)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        $tab_p = ModelLignePanier::getAllProduitsPanier($idPanier);
        require_once File::build_path(array("view", "all.php"));
    }

    public static function add_LignePanier($idPanier)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::truc();
        //header("Location:index.php?");
    }
    public static function remove_LignePanier($idPanier)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::truc();
        //header("Location:index.php?");
    }


}