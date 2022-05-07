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

    public static function getAllProduitsPanier($idPanier) {
        $req = Model::getPDO()->prepare( "SELECT idProduit, qte FROM lignePanier WHERE idPanier = :idPanier");
        $array = array(
            "idPanier" => $idPanier,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelLignePanier');
        return $req->fetchAll();
    }


    public static function addLignePanier($idProduit){
        if (!isset($_SESSION['panierSiteDeVente'])) {
            $_SESSION['panierSiteDeVente'] = [];
        }
        $panier = $_SESSION['panierSiteDeVente'];
        $id_p = $idProduit;
        // verifie si le produit n'est pas dans le panier
        if (!isset($panier[$id_p]))
            $panier[$id_p] = ['qte' => 1];
        else
            $panier[$id_p]['qte']++;

        $_SESSION['panierSiteDeVente'] = $panier;
        header('Location:index.php');
    }

    public static function removeLignePanier($idProduit) {
        $panier = $_SESSION['panierSiteDeVente'];
        $id_p = $idProduit;

        if ($panier[$id_p]['qte'] > 1)
            $panier[$id_p]['qte']--;
        else
            unset($panier[$id_p]);

        $_SESSION['panierSiteDeVente'] = $panier;
        header('Location:index.php');
    }

    /**
     * Pour chacun des éléments dans panierSiteDeVente, on vient vérifier si le produit est déjà présent sur la base de donnée.
     * Si le produit est présent dans le panier de l'utilisateur alors :
     * On réécrit la session pour correspondre à la Bdd. (BDD > $_SESSION)
     * Sinon :
     * On vient créer une ligne pour ledit produit dans la bdd.
     */
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
                //TODO : Session ou BDD prioritaire ?
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
    }

    /**
     * On vient récupérer tous les articles correspondant à $_SESSION['idPanier'] et
     * pour chacun d'eux, on vient vérifier s'ils sont présents dans $_SESSION['panierSiteDeVente'].
     * Dans le cas où ils n'y seraient pas, on les ajoutes à $_SESSION.
     * Si ils y sont déjà, on garde l'article inchangé ($_SESSIONS > BDD) et on vient l'ajouter à la BDD.
     */

    public static function copiePanierBddLignePanier() {

        //header("Location:index.php");
    }

    public function getIdProduit() { return $this->idProduit; }
    public function getIdPanier() { return $this->idPanier; }
    public function getQte() { return $this->qte; }
}
