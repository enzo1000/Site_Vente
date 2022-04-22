<?php

class ControllerProduit
{
    /*
     * On stocke tout les produits dans un tableau (FETCH_CLASS)
     * On va ensuite afficher chacune d'entre elles dans all.php
     */
    public static function readAll_Produit()
    {
        require_once File::build_path(array("model", "ModelProduit.php"));
        $tab_p = ModelProduit::getAllProduits();
        require_once File::build_path(array("view", "all.php"));
    }

    public static function read_Produit($idProduit)
    {
        require_once File::build_path(array("model", "ModelProduit.php"));
        $produit = ModelProduit::getProduit($idProduit);
        require_once File::build_path(array("view", "single.php"));
    }

    public static function home() {
        header("Location:./index.php?action=readAll_Produit");
    }
}