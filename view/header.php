<!DOCTYPE html>
<html lang="fr">
<head>

    <style>
        .header  {
            height: 90px;
            margin: 0;
            background : #000000;
        }
    </style>

</head>
<body>

<div class='header'>
    <button type="button" >
    <?php
        echo "<a href= ./index.php?controller=ControllerPanier&action=test>";
        echo "Panier Piano";
        echo "</a>";
    ?>
    </button>

    <button type="button" >
        <?php
        echo "<a href= ./index.php?controller=ControllerUtilisateur&action=printForm_Utilisateur&param=formConnexion>";
        echo "Connexion";
        echo "</a>";
        ?>
    </button>

</div>
</body>
</html>