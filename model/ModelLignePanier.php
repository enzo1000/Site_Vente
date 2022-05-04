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

    public function getIdProduit() { return $this->idProduit; }
    public function getIdPanier() { return $this->idPanier; }
    public function getQte() { return $this->qte; }
}
