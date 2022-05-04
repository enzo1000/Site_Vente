<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view/CSS/index.css">
</head>
<body>

<?php require_once File::build_path(array("view", "header.php")); ?>

<div class='liste'>

    <?php
    foreach ($tab_p as $produit) {

        echo "<div class='article'>"
            . "<div class='container'>"
            . "<div class='image'>"
            . "<img src='view/images/" . $produit->getPhoto() . "/1.png' class='image' alt=" . "Produit_" . $produit->getId() . " title=" . $produit->getId() . ">"
            . "</div>"
            . "<div class='titre'>"
            . "<a href=./index.php?controller=ControllerProduit&action=read_Produit&param=" . $produit->getId() . ">" . $produit->getNom() . "</a>"
            . "</div>"
            . "<div class='prix'>" . $produit->getPrix() . " €</div>"
            . "<div class='description'>" . $produit->getDescription() . "</div>"

            . "<button class='like button' id='like:" . $produit->getId() . "' onclick='likeJS(id)'></button>"

            . "<a href='index.php?controller=ControllerLignePanier&action=add_LignePanier&param=" . $produit->getId() . "'>"
            . "<button class='add button' id='add:" . $produit->getId() . "'onclick='addJS(id)'></button>"
            . "</a>";


        if (isset($_SESSION['panierSiteDeVente'][$produit->getId()]))
            echo "<a href='index.php?controller=ControllerLignePanier&action=remove_LignePanier&param=" . $produit->getId() . "'>"
                . "<button class='remove button' id='remove:" . $produit->getId() . "'onclick='removeJS(id)'></button>"
                . "</a>"
                . $_SESSION['panierSiteDeVente'][$produit->getId()]['qte'];

        echo "</div>"
            . "</div>";
    }
    ?>

</div>

<script type="text/javascript">
    function likeJS(id) {
        document.getElementById(id).style.backgroundColor = "#FEEBEA";
        document.getElementById(id).style.backgroundImage = "url('view/images/logo_coeur_active.png')";
    }

    function addJS(id) {
        document.getElementById(id).style.backgroundColor = "#3BAD27";
        document.getElementById(id).style.backgroundImage = "url('view/images/logo_panier_active_add.png')";
    }

    function removeJS(id) {
        document.getElementById(id).style.backgroundColor = "#FF0000";
        document.getElementById(id).style.backgroundImage = "url('view/images/logo_panier_active_rem.png')";
    }
</script>


</body>

</html>