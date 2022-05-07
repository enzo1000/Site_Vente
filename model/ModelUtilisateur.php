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
     * A partir d'un mail et d'un mdp fournit en formulaires ou dans $_SESSION, (suite à un passage dans inscription)
     * si l'utilisateur n'a pas de compte alors on re-affiche le formulaire de connexion
     * tout en proposant à l'utilisateur de créer un compte.
     * Sinon, on ajoute les informations de l'utilisateur dans $_SESSION['Utilisateur']
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
                $_SESSION['ModelUtilisateur']['nom'] = $reponse[0]->getNom();
                $_SESSION['ModelUtilisateur']['prenom'] = $reponse[0]->getPrenom();
                $_SESSION['ModelUtilisateur']['mail'] = $reponse[0]->getMail();
                $_SESSION['ModelUtilisateur']['mdp'] = $reponse[0]->getMdp();

                require_once File::build_path(array("model", "ModelPanier.php"));

                $idPanier = ModelPanier::creerPanierUtilisateur();

                if (isset($_SESSION['panierSiteDeVente'])) {
                    require_once File::build_path(array("model", "ModelLignePanier.php"));
                    ModelLignePanier::copiePanierUtilisateur($idPanier);
                }

                //TODO dé commenter header("Location:index.php");
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

    /**
     *  Suite au passage de l'utilisateur par le formulaire d'inscription,
     * On vérifie si ses mots de passes sont valides puis que son adresses mail n'est pas déjà utilisée
     */
    public static function inscriptionUtilisateur()
    {
        if ($_POST['mdp'] != $_POST['mdp2']) {
            require File::build_path(array("view", "formulaires", "formInscription.php"));
            echo "<p>deux mdp non identiques, veuillez resaisir <p> <div></div> <div></div>";
        } else {
            $sql = "SELECT COUNT(*) FROM utilisateur WHERE mail = :mail";
            $requete = Model::getPDO()->prepare($sql);
            $values = array(
                "mail" => $_POST['mail']
            );

            $requete->execute($values);
            $reponse = $requete->fetch(PDO::FETCH_NUM);

            if ($reponse[0] != 0) {
                require File::build_path(array("view", "formulaires", "formInscription.php"));
                echo "Ce mail a déjà été utilisée";

            } else {
                $newCompte = "INSERT INTO utilisateur VALUES (:nom, :prenom, :mail, :mdp)";
                $requete = Model::getPDO()->prepare($newCompte);
                $values = array(
                    "nom" => $_POST['nom'],
                    "prenom" => $_POST['prenom'],
                    "mail" => $_POST['mail'],
                    "mdp" => $_POST['mdp']
                );

                $requete->execute($values);
                echo "Bienvenue !" . $_POST['nom'] . $_POST['prenom'];
                header("Location:index.php");
            }
        }
    }

    public static function deconnexionUtilisateur()
    {
        session_destroy();
        unset($_SESSION);
        header("Location:index.php");
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