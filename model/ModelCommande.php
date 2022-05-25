<?php

class ModelCommande
{
    private $idCommande;
    private $email;
    private $date;
    private $montantTotal;

    public static function creerCommande($montantTotal)
    {
        $numCom = "SELECT idCommande FROM commande WHERE email = :mail";
        $array = array(
            "mail" => $_SESSION['ModelUtilisateur']['mail'],
        );

        $req = Model::getPDO()->prepare($numCom);
        $req->execute($array);
        $idCommande = $req->rowCount();

        $insert = "INSERT INTO commande (idCommande, email, montantTotal) VALUES (:idCommande, :email, :montantTotal)";
        $prep = Model::getPDO()->prepare($insert);
        $array = array(
            "idCommande" => $idCommande,
            "email" => $_SESSION['ModelUtilisateur']['mail'],
            "montantTotal" => $montantTotal,
        );
        $prep->execute($array);

        return $idCommande;
    }
}