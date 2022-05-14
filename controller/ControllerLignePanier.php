<?php


class ControllerLignePanier
{
    public static function readAll_LignePanier($idPanier)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        $tab_p = ModelLignePanier::getAllProduitsPanier($idPanier);
        require_once File::build_path(array("view", "all.php"));
    }

    public static function add_LignePanier($idProduit)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::addLignePanier($idProduit);
    }

    public static function remove_LignePanier($idProduit)
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::removeLignePanier($idProduit);
    }

    public static function copiePanierBdd_LignePanier()
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::copiePanierBddLignePanier();
    }

    public static function afficherPanier_LignePanier()
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        $tabProduit = ModelLignePanier::getAllProduitsPanier($_SESSION['idPanier']);
        require_once File::build_path(array("view", "lignePanier.php"));
    }

    public static function delete_LignePanier()
    {
        require_once File::build_path(array("model", "ModelLignePanier.php"));
        ModelLignePanier::deleteLignePanier();
        header("Location:./index.php?controller=ControllerPanier&action=delete_Panier");
    }
}