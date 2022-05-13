<?php

class ModelPanier
{
    private $idPanier;
    private $date;
    private $idUtilisateur;

    public static function getPanier($idUtilisateur)
    {
        $req = Model::getPDO()->prepare(" SELECT idPanier FROM Panier WHERE idUtilisateur = :idUtilisateur");
        $array = array(
            "idUtilisateur" => $idUtilisateur,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $idPanier = $req->fetchAll();

        header("Location:./index.php?controller=ControllerLignePanier&action=readAll_LignePanier&param=" . $idPanier[0]);
    }

    /**
     * On vient vérifier si l'utilisateur a un panier sur la base de donnée
     *  de manière à pouvoir lui en créer un dans le cas échéant où il n'en aurait pas.
     * On vient ensuite copier dans copier l'idPanier dans $_SESSION['idPanier'];
     * Note : On peut réaliser la méthode si dessous sans passer par du récursif.
     * Si le récursif est alors trop gourmand, il faudra favoriser cette option
     *
     * Retourne un $_SESSION['idPanier'] contenant l'idPanier sur la BDD.
     */
    public static function creerPanier()
    {
        $panierExiste = "SELECT * FROM Panier ORDER BY idPanier"; //On récup tout les paniers
        $req = Model::getPDO()->query($panierExiste);
        $req->fetch(PDO::FETCH_CLASS, 'ModelPanier');
        $res = $req->fetchAll();

        if (!File::in_array_r($_SESSION['ModelUtilisateur']['mail'], $res)) {   //Si l'utilisateur n'en a pas
            for ($i = 0; $i < sizeof($res) && !isset($idPanier); $i++) {  //On cherche une place dans les idPanier dans la base
                if ($i != $res[$i]["idPanier"]) {    //S'il y a une place alors on créer un panier ici
                    $idPanier = $i;
                }
            }
            if (!isset($idPanier)) {                //Sinon on le créer en fin de file
                $idPanier = sizeof($res);
            }

            $panierAjout = "INSERT INTO panier VALUES (:idPanier, CURRENT_TIMESTAMP, :idUtilisateur);";
            $req = Model::getPDO()->prepare($panierAjout);
            $array = array(
                "idPanier" => $idPanier,
                "idUtilisateur" => $_SESSION['ModelUtilisateur']['mail'],
            );
            $req->execute($array);

            $_SESSION['idPanier'] = $idPanier;
        } else {    //L'utilisateur a alors un panier

            $idPanier = "SELECT idPanier FROM Panier WHERE idUtilisateur = :idUtilisateur";
            $req = Model::getPDO()->prepare($idPanier);

            $array = array(
                "idUtilisateur" => $_SESSION['ModelUtilisateur']['mail'],
            );

            $req->execute($array);
            $req->fetch(PDO::FETCH_CLASS, 'ModelPanier');
            $res = $req->fetchAll();

            $_SESSION['idPanier'] = $res[0]['idPanier'];
        }

        header("Location:index.php?controller=ControllerLignePanier&action=copiePanierBdd_LignePanier");
    }
}