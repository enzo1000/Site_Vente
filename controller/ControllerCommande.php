<?php

class ControllerCommande
{
    public static function creerCommande_Commande($prixTotal)
    {
        require_once File::build_path(array("model", "ModelCommande.php"));
        $idCommande = ModelCommande::creerCommande($prixTotal);
        $_SESSION["idCommande"]=$idCommande;
        header("Location:./view/paiement.php");
        //header("Location:./index.php?controller=ControllerCommande&action=finCommande");
        //header("Location:./index.php?controller=ControllerLigneCommande&action=copieLignePanier_LigneCommande&param={$idCommande}");
    }
    public static function gererPdf(){
        require_once File::build_path(array("model", "ModelCommande.php"));
        ModelCommande::pdf();
    }
    public static function retourPageAccueil(){
        header("Location:./index.php?controller=ControllerLigneCommande&action=copieLignePanier_LigneCommande&param={$_SESSION["idCommande"]}");
    }

}
