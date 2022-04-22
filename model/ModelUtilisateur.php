<?php

class ModelUtilisateur
{
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;

    public static function getAllUtilisateurs()
    {
        $req = Model::getPDO()->query("SELECT * FROM utilisateurs");
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        return $req->fetchAll();
    }

    public static function getutilisateur($idUtil) {
        $req = Model::getPDO()->prepare("SELECT * FROM utilisateurs WHERE id = :idUtil");
        $array = array(
            "idUtil" => $idUtil,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req->fetchAll();
        return $utilisateur[0];

    }


    public function getNom() { return $this->nom; }

    public function getPrenom(){ return $this->prenom; }
    
    public function getMail(){ return $this->mail; }

    public function getMdp(){ return $this->mdp; }



}