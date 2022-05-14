<?php

class ModelLigneCommande
{
    private $idProduit;
    private $idPanier;
    private $email;
    private $qte;

    public static function copieLignePanierVersLigneCommande($idCommande) {

        $copie = "INSERT INTO ligneCommande (idProduit, idCommande, email, qte)
                    SELECT lp.idProduit, com.idCommande, lp.idUtilisateur, lp.qte 
                        FROM lignePanier lp 
                        JOIN Utilisateur u ON lp.idUtilisateur = u.mail
                        JOIN Commande com ON u.mail = com.email
                        WHERE lp.idUtilisateur = :email
                        AND com.idCommande = :idCommande";
        $insert = Model::getPDO()->prepare($copie);

        $array = array(
            "email" => $_SESSION['ModelUtilisateur']['mail'],
            "idCommande" => $idCommande,
        );

        $insert->execute($array);
    }
}