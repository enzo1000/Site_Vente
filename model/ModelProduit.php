<?php

//Initialise la connexion avec la BDD
include_once File::build_path(array("model", "Model.php"));

echo "Tu es dans ModelProduit.php";

class ModelProduit
{
    private $id;
    private $nom;
    private $prix;
    private $description;
    private $photo;
    private $nomCategorie;

    /*
     * Méthode qui affiche toutes les informations d'un livre dans cet ordre:
     * photo, nom, nomCategorie, prix, description.
     */

    public static function getAllProduits()
    {
        $req = Model::getPDO()->query("SELECT * FROM produits");
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req->fetchAll();
    }

    public function getId(){ return $this->id;}

    public function getNom(){ return $this->nom; }

    public function getPrix(){ return $this->prix; }

    public function getDescription(){ return $this->description; }

    public function getPhoto() { return $this->photo; }

    public function getNomCategorie(){ return $this->nomCategorie; }


}