<?php

class ControllerLigneCommande
{
    public static function copieLignePanier_LigneCommande($idCommande) {
        require_once File::build_path(array("model", "ModelLigneCommande.php"));
        ModelLigneCommande::copieLignePanierVersLigneCommande($idCommande);
        header("Location:./index.php?controller=ControllerLignePanier&action=delete_LignePanier");
    }
}