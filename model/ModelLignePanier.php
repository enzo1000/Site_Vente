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
        $req = Model::getPDO()->prepare( "SELECT idProduit, qte FROM lignePanier
             WHERE idPanier = :idPanier");
        $array = array(
            "idPanier" => $idPanier,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelLignePanier');
        return $req->fetchAll();
    }

    public function getIdProduit() { return $this->idProduit; }
    public function getIdPanier() { return $this->idPanier; }
    public function getQte() { return $this->qte; }
}