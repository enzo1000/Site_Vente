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


    public static function truc(){

        if (!isset($_SESSION['panier2'])) {
            $_SESSION['panier2'] = [];
        }
        $panier = $_SESSION['panier2'];
        $id_p = $_GET['param'];
        $action = $_GET['action'];
// verifie si le produit n'est pas dans le panier
        if (!isset($panier[$id_p])) {
            $panier[$id_p] = ['qte' => 1];

        }else{
            if ($action=='add')
                $panier[$id_p]['qte']++;
            if ($action=='remove'){
                $panier[$id_p]['qte']--;
            }
        }

        $_SESSION['panier2'] = $panier;
        header('Location:index.php');

        var_dump($panier);
    }

    public function getIdProduit() { return $this->idProduit; }
    public function getIdPanier() { return $this->idPanier; }
    public function getQte() { return $this->qte; }
}
