<?php

class ModelPanier
{
    private $idPanier;
    private $timestamp;
    private $idUtilisateur;

    public static function getPanier ($idUtilisateur) {
        $req = Model::getPDO()->prepare(" SELECT idPanier FROM Panier WHERE idUtilisateur = :idUtilisateur");
        $array = array(
            "idUtilisateur" => $idUtilisateur,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $idPanier = $req->fetchAll();

        header( "Location:./index.php?controller=ControllerLignePanier&action=readAll_LignePanier&param=" . $idPanier[0]);
    }

}