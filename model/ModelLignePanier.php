<?php

class ModelLignePanier
{
    private $idProduit;
    private $idPanier;
    private $qte;

    /**
     * Retourne une liste d'article avec leurs quantitée (sur une ligne)
     * à partir d'un idPanier fournit en paramètre
     */

    public static function getAllProduitsPanier($idPanier)
    {
        $req = Model::getPDO()->prepare("SELECT id, nom, prix, description, photo, nomCategorie, qte 
            FROM lignePanier lp JOIN Produits p ON idProduit = id WHERE idPanier = :idPanier");
        $array = array(
            "idPanier" => $idPanier,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req->fetchAll();
    }

    public static function addLignePanier($idProduit)
    {
        if (!isset($_SESSION['panierSiteDeVente'])) {
            $_SESSION['panierSiteDeVente'] = [];
        }
        $panier = $_SESSION['panierSiteDeVente'];
        $id_p = $idProduit;
        // verifie si le produit n'est pas dans le panier
        if (!isset($panier[$id_p])) {
            $panier[$id_p]['qte'] = 1;
            $sql = "INSERT INTO LignePanier VALUES (:idProduit, :idPanier, :idUtilisateur, :qte);";

            echo "<pre>";
            var_dump($_SESSION);

            $array = array(
                "qte" => $panier[$id_p]['qte'],
                "idPanier" => $_SESSION['idPanier'],
                "idUtilisateur" => $_SESSION['ModelUtilisateur']['mail'],
                "idProduit" => $id_p,
            );

        } else {
            $panier[$id_p]['qte']++;
            $sql = "UPDATE LignePanier SET qte = :qte WHERE idPanier = :idPanier AND idProduit = :idProduit;";

            $array = array(
                "qte" => $_SESSION['panierSiteDeVente'][$id_p]['qte'],
                "idPanier" => $_SESSION['idPanier'],
                "idProduit" => $id_p,
            );
        }
        $_SESSION['panierSiteDeVente'] = $panier;
        if (isset($_SESSION['idPanier'])) {     //Si idPanier est défini, il faut alors modifier la base de données.
            Model::getPDO()->prepare($sql)->execute($array);
        }

        header('Location:index.php');
    }

    public static function removeLignePanier($idProduit)
    {
        $panier = $_SESSION['panierSiteDeVente'];
        $id_p = $idProduit;

        if ($panier[$id_p]['qte'] > 1) {
            $panier[$id_p]['qte']--;

            if (isset($_SESSION['idPanier'])) {
                $sql = "UPDATE LignePanier SET qte = :qte WHERE idPanier = :idPanier AND idProduit = :idProduit;";
                $array = array(
                    "qte" => $panier[$id_p]['qte'],
                    "idPanier" => $_SESSION['idPanier'],
                    "idProduit" => $id_p,
                );
            }
        } else {
            unset($panier[$id_p]);

            $sql = "DELETE FROM LignePanier WHERE idProduit = :id_p;";
            $array = array("id_p" => $id_p);
        }

        $_SESSION['panierSiteDeVente'] = $panier;

        if (isset($_SESSION['idPanier'])) {
            Model::getPDO()->prepare($sql)->execute($array);
        }

        header('Location:index.php');
    }



    /*
     * Pour chacun des éléments dans panierSiteDeVente, on vient vérifier si le produit est déjà présent sur la base de donnée.
     * Si le produit est présent dans le panier de l'utilisateur alors :
     * On réécrit la session pour correspondre à la Bdd. (BDD > $_SESSION)
     * Sinon :
     * On vient créer une ligne pour ledit produit dans la bdd.
    */
    /*
    public static function copiePanierLignePanier()
    {
        $idPanier = $_SESSION['idPanier'];
        foreach ($_SESSION['panierSiteDeVente'] as $idProduit => $array) {
            $nbProduit = "SELECT qte FROM LignePanier l " .
                " WHERE idPanier = :idPanier && idProduit = :idProduit";
            $req = Model::getPDO()->prepare($nbProduit);

            $array = array(
                "idPanier" => $idPanier,
                "idProduit" => $idProduit
            );

            $req->execute($array);
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelLignePanier[qte]');
            $reponse = $req->fetchAll();

            if ($reponse == false) {
                $req = "INSERT INTO LignePanier VALUES (:idProduit, :idPanier, :qte);";
                $reponse = $_SESSION['panierSiteDeVente'][$idProduit]['qte'];
            } else {
                $req = "UPDATE LignePanier SET qte = :qte "
                    . " WHERE idPanier = :idPanier AND idProduit = :idProduit";
                $reponse = intval($reponse[0][0]);  //Ici BDD sinon voir $_SESSION ligne 83
                $_SESSION['panierSiteDeVente'][$idProduit]['qte'] = $reponse;
            }

            $prep = Model::getPDO()->prepare($req);
            $array = array(
                "idPanier" => $idPanier,
                "idProduit" => $idProduit,
                "qte" => $reponse,
            );
            $prep->execute($array);
        }
    }*/

    /**
     * vient récupérer le panier dans base de donnée.
     * Si l'utilisateur n'en a pas alors on conserve son panier de $_Session et on l'insère dans la table Ligne Panier
     * Sinon on écrase son panier de $_Session
     */

    public static function copiePanierBddLignePanier()
    {
        $listeArticle = "SELECT * FROM LignePanier WHERE idPanier =" . $_SESSION['idPanier'] . " ORDER BY idProduit;";
        $req = Model::getPDO()->query($listeArticle);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelLignePanier');
        $rep = $req->fetchAll();

        if ($rep != false) {
            unset($_SESSION['panierSiteDeVente']);
            foreach ($rep as $lignePanier => $objLigne) {                        //Pour chacune des lignes dans la bdd
                $_SESSION['panierSiteDeVente'][$objLigne->getIdProduit()]['qte'] = $objLigne->getQte();
            }
        } else {
            foreach ($_SESSION['panierSiteDeVente'] as $cle => $Produit) {                      //Pour chacune des lignes dans $_SESSION['panierSiteDeVente'];
                $insert = "INSERT INTO LignePanier VALUES (:idProduit, :idPanier, :idUtilisateur, :qte);";      //Vu qu'il n'y a rien dans la BDD, on vient y insérer la $_SESSION
                $req = Model::getPDO()->prepare($insert);
                $array = array(
                    "idProduit" => $cle,
                    "idPanier" => intval($_SESSION['idPanier']),
                    "idUtilisateur" => $_SESSION['ModelUtilisateur']['mail'],
                    "qte" => $_SESSION['panierSiteDeVente'][$cle]['qte'],
                );
                $req->execute($array);
            }
        }
        header("Location:index.php");
    }

    public static function deleteLignePanier() {
        $sql = "DELETE FROM lignePanier WHERE idPanier = :idPanier";
        $prep = Model::getPDO()->prepare($sql);
        $array = array(
            "idPanier" => $_SESSION['idPanier'],
        );
        $prep->execute($array);
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function getIdPanier()
    {
        return $this->idPanier;
    }

    public function getQte()
    {
        return $this->qte;
    }
}
