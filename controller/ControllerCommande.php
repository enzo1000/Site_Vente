<?php

class ControllerCommande
{
    public static function creerCommande_Commande($prixTotal)
    {
        require_once File::build_path(array("model", "ModelCommande.php"));
        $idCommande = ModelCommande::creerCommande($prixTotal);
        header("Location:./index.php?controller=ControllerLigneCommande&action=copieLignePanier_LigneCommande&param={$idCommande}");
    }
}
