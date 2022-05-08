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
    <button type="button">
        <?php
        echo "<a href= ./index.php?controller=ControllerPanier&action=panier_Panier&param=>";
        echo "Panier";
        if (isset($_SESSION['idPanier'])) {

        }
        echo "</a>";
        ?>
    </button>

    <?php
    if (isset($_SESSION['panierSiteDeVente'])) {
        $total = 0;
        foreach ($_SESSION['panierSiteDeVente'] as $produit => $item) {
            $total += $_SESSION['panierSiteDeVente'][$produit]['qte'];
        }
        echo "<button type='button'>";
        echo $total;
        echo "</button>";
    }
    ?>

    <?php
    if (!isset($_SESSION['ModelUtilisateur'])) {
        echo "<button type='button' >";
        echo "<a href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formConnexion>";
        echo "Connexion";
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