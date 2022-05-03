<?php


class ControllerLignePanier
{
    public static function readAll_LignePanier()
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        $tab_p = ModelLignePanier::getAllProduitsPanier($idPanier);
        require_once File::build_path(array("view", "lignePanier.php"));
    }

}