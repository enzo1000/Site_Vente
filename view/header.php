<!DOCTYPE html>
<html lang="fr">
<head>

    <title>Bienvenue <?php
        if (isset($_SESSION['ModelUtilisateur'])) {
            echo $_SESSION['ModelUtilisateur']['nom'];
        } else echo "Guest"; ?>
    </title>

    <style>
        .header {
            height: 90px;
            margin: 0;
            background: white;
        }
    </style>

</head>
<body>

<div class='header'>
    <?php
    if (isset($_SESSION['panierSiteDeVente'])) {
        echo "<button type='button'>";
        if (isset($_SESSION['idPanier'])) {
            echo "<a href= ./index.php?controller=ControllerLignePanier&action=afficherPanier_LignePanier>";
            echo "Panier";
            echo "</a>";
        } else {
            echo "<a href= ./index.php?controller=ControllerProduit&action=modal_Produit>";
            echo "Panier";
            echo "</a>";
        }
        echo "</button>";

        $total = 0;
        foreach ($_SESSION['panierSiteDeVente'] as $produit => $item) {
            $total += $_SESSION['panierSiteDeVente'][$produit]['qte'];
        }
        echo "<button type='button'>";
        echo $total;
        echo "</button>";
    }

    if (!isset($_SESSION['ModelUtilisateur'])) {
        echo "<button type='button' >";
        echo "<a href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formConnexion>";
        echo "Connexion";
        echo "</a>";
        echo "</button>";
        echo "<button type='button' >";
        echo "<a href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formInscription>";
        echo "Inscription";
        echo "</a>";
        echo "</button>";
    } else {
        echo "<button type='button' >";
        echo "<a href= ./index.php?controller=ControllerUtilisateur&action=deconnexion_Utilisateur>";
        echo "Deconnexion";
        echo "</a>";
        echo "</button>";
    }
    ?>

</div>
</body>
</html>