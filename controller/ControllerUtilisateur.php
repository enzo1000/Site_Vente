<?php

class ControllerUtilisateur {
    public static function readAll_Joueur()
    {
        require_once File::build_path(array("model", "ModelUtilisateur.php"));
        $tab_p = ModelUtilisateur::getAllUtilisateurs();
        require_once File::build_path(array("view", "all.php"));
    }

    public static function read_Joueur($idJoueur)
    {
        require_once File::build_path(array("model", "ModelUtilisateur.php"));
        $produit = ModelUtilisateur::getUtilisateur($idUtil);
        require_once File::build_path(array("view", "single.php"));
    }

}