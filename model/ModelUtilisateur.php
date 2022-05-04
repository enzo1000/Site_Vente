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

    public static function getUtilisateur($idUtil) {
        $req = Model::getPDO()->prepare("SELECT * FROM utilisateurs WHERE id = :idUtil");
        $array = array(
            "idUtil" => $idUtil,
        );
        $req->execute($array);
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req->fetchAll();
        return $utilisateur[0];
    }

    public static function connexionUtilisateur(){
        try {
            $sql = "SELECT * FROM utilisateur WHERE mail= :mail AND mdp=:mdp";
            $requete = Model::getPDO()->prepare($sql);
            if(isset($_POST['mail'])&&isset($_POST['mdp'])){
                $values = array(
                    "mail" => $_POST['mail'],
                    "mdp" => $_POST['mdp'],
                );
            }
            else if(isset($_SESSION['mail'])&&isset($_SESSION['mdp'])){
                $values = array(
                    "value1" => $_SESSION['mail'],
                    "value2" => $_SESSION['mdp'],
                );
            }

            $requete->execute($values);
            //$requete->setFetchMode(PDO::FETCH_CLASS, 'ModelJoueur');
            $reponse = $requete->fetchAll();

            if ($reponse == false) {
                echo "mdp ou mail incorrect";
                self::formConnexion();
                echo "<a href='index.php?controller=ICD&action=formInscription'> pas de compte ? créer un compte mtn</a>";
            } else {
                // echo "<pre>";
                //var_dump($reponse);
                $_SESSION['joueur']=$reponse[0];
                $_SESSION['pseudo']=$reponse[0]['pseudo'];
                //var_dump($_SESSION['pseudo']);
                $_SESSION['mail']=$reponse[0]['mail'];
                $_SESSION['mdp']=$reponse[0]['mdp'];
                //var_dump($_SESSION['mail']);
                // header("Location:view/accueil.php");

                /*
                $sql = "SELECT mail FROM admin WHERE mail='{$_POST['mail']}'";
                $requete=$conn->query($sql);
                if($reponse!=false){
                    echo "<a href='admin.php'> gérer les créatures </a>";
                }*/
            }
        }
        catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue, <a href="./index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }

    }


    public function getNom() { return $this->nom; }
    public function getPrenom(){ return $this->prenom; }
    public function getMail(){ return $this->mail; }
    public function getMdp(){ return $this->mdp; }
}