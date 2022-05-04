<?php

include_once File::build_path(array("model", "Model.php"));

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

    public static function getUtilisateur($idUtil)
    {
        $req = Model::getPDO()->prepare("SELECT * FROM utilisateurs WHERE id = :idUtil");
        $array = array(
            "idUtil" => $idUtil,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req->fetchAll();
        return $utilisateur[0];
    }

    /**
     * A partir d'un mail et d'un mdp fournit en formulaires ou dans $_SESSION,
     * si l'utilisateur n'a pas de compte
     *
     */

    public static function connexionUtilisateur()
    {
        try {
            $sql = "SELECT * FROM utilisateur WHERE mail = :mail AND mdp = :mdp";
            $requete = Model::getPDO()->prepare($sql);

            if (isset($_SESSION['mail']) && isset($_SESSION['mdp'])) {
                $values = array(
                    "mail" => $_SESSION['mail'],
                    "mdp" => $_SESSION['mdp'],
                );
            } else if (isset($_POST['mail']) && isset($_POST['mdp'])) {
                $values = array(
                    "mail" => $_POST['mail'],
                    "mdp" => $_POST['mdp'],
                );
            }

            $requete->execute($values);
            $requete->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $reponse = $requete->fetchAll();

            if ($reponse == false) {
                require File::build_path(array("view", "formulaires", "formConnexion.php"));
                echo "mdp ou mail incorrect" . "<br>";
                echo "<a href='./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formInscription'> pas de compte ? créer un compte mtn</a>";
            } else {

                //On indexe dans session notre utilisateur

                $_SESSION['utilisateur'] = $reponse[0];
                $_SESSION['nom'] = $reponse[0]['nom'];
                $_SESSION['prenom'] = $reponse[0]['prenom'];
                $_SESSION['mail'] = $reponse[0]['mail'];
                $_SESSION['mdp'] = $reponse[0]['mdp'];

            }
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue, <a href="./index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function inscriptionUtilisateur()
    {

    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getMdp()
    {
        return $this->mdp;
    }
}