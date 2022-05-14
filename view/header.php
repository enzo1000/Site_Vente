<!DOCTYPE html>

<html lang="fr">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>

    <title>Bienvenue <?php
        if (isset($_SESSION['ModelUtilisateur'])) {
            echo $_SESSION['ModelUtilisateur']['nom'];
        } else echo "Guest"; ?>
    </title>

    <style>
        .content-header h1 {
            margin-left: 20px;
            line-height: 65px;
            display: inline-block;
        }

        header .main-nav {
            background-color: #FA8072;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 4000;
            max-height: 69px;
        }

        header {
            background-color: rgba(0, 0, 0, 0.4);
        }

        a.btn.btn-lg.btn-success {
            line-height: 1.1;
            margin-top: 12px;
        }

        a.btn.btn-lg.btn-info {
            line-height: 1.1;
            margin-top: 12px;
        }

        .navbar-light {
            color: #fff;
        }

        .navbar-light {
            color: #00e0d0;
        }

        .ds-btn li {
            list-style: none;
            float: right;
            padding: 10px;
        }

    </style>

</head>
<div class="row">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light text-light py-3 main-nav">
            <div class="contenu_header">
                <ul class="ds-btn">
                    <?php
                    if (isset($_SESSION['panierSiteDeVente'])) {
                        $total = 0;
                        foreach ($_SESSION['panierSiteDeVente'] as $produit => $item) {
                            $total += $_SESSION['panierSiteDeVente'][$produit]['qte'];
                        }
                        echo "<li>";
                        echo "<span>";
                        echo "<a class='btn btn-lg btn-info'>";
                        echo "Nombre d'articles dans votre panier : " . $total;
                        echo "</a>";
                        echo "</span>";
                        echo "</li>";

                        echo "<li>";
                        if (isset($_SESSION['idPanier'])) {
                            echo "<a class='btn btn-lg btn-success' href= ./index.php?controller=ControllerLignePanier&action=afficherPanier_LignePanier>";
                            echo "<span>";
                            echo "Panier";
                        } else {
                            echo "<span>";
                            echo "<a class='btn btn-lg btn-success'>";
                            echo "Connexion requise pour <br> consulter votre panier";
                            echo "</a>";
                        }
                        echo "</span>";
                        echo "</a>";
                        echo "</li>";

                    }

                    echo "<li>";
                    echo "<span>";
                    if (!isset($_SESSION['ModelUtilisateur'])) {
                        echo "<a class='btn btn-lg btn-success' href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formConnexion>";
                        echo "Connexion";
                        echo "</a>";
                        echo "</span>";
                        echo "</li>";

                        echo "<li>";
                        echo "<span>";
                        echo "<a class='btn btn-lg btn-success' href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formInscription>";
                        echo "Inscription";
                    } else {
                        echo "<a class='btn btn-lg btn-success' href= ./index.php?controller=ControllerUtilisateur&action=deconnexion_Utilisateur>";
                        echo "Deconnexion";
                    }
                    echo "</a>";
                    echo "</span>";
                    echo "</li>";
                    echo "<li>";
                    echo "<span>";
                    echo "<a class='btn btn-lg btn-success' href= ./index.php>";
                    echo "Accueil";
                    echo "</a>";
                    echo "</span>";
                    echo "</li>";

                    ?>
                </ul>
            </div>
        </nav>
    </header>
</div>
</html>