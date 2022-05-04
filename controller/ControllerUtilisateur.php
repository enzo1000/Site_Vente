<?php

class ControllerUtilisateur {
    public static function readAll_Utilisateur()
    {
        require_once File::build_path(array("model", "ModelUtilisateur.php"));
        $tab_p = ModelUtilisateur::getAllUtilisateurs();
        require_once File::build_path(array("view", "all.php"));
    }

    public static function read_Utilisateur($idUtil)
    {
        require_once File::build_path(array("model", "ModelUtilisateur.php"));
        $produit = ModelUtilisateur::getUtilisateur($idUtil);
        require_once File::build_path(array("view", "single.php"));
    }

    public static function printForm_Utilisateur($nomForm) {
        require_once File::build_path(array("view", "formulaires", "$nomForm.php"));
    }

    public static function connexion_Utilisateur() {
        require_once File::build_path(array("model","ModelUtilisateur.php"));
        ModelUtilisateur::connexionUtilisateur();
    }

    public static function inscription_Utilisateur() {
        require_once File::build_path(array("model","ModelUtilisateur.php"));
        ModelUtilisateur::inscriptionUtilisateur();
    }
}