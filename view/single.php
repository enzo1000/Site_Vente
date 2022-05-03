<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view/CSS/index.css">
    <title>Bienvenue <?php
        if (isset($_SESSION['pseudo'])) {
            echo $_SESSION['pseudo'];
        } else echo "Guest" ?></title>
</head>
<body>

<div class="liste">

<?php
echo "<div class='article'>"
    . " Livre n°" . $produit->getId()
    . "<div class='container'>"
    . "<div class='image'>"
    . "<img src='view/images/" . $produit->getPhoto() . "/1.png' class='image' alt=" . "texte alternatif" . " title=" . "Titre de l'image/>"
    . "</div>"
    . "<div class='titre'>"
    . "<a href=./index.php?controller=ControllerProduit&action=read_Produit&param=" . $produit->getId() . ">" . $produit->getNom() . "</a>"
    . "</div>"
    . "<div class='prix'>" . $produit->getPrix() . " €</div>"
    . "<button class='like button' id='" . $produit->getId() . "'onclick='myFunction(" . $produit->getId() . ")'></button>"
    . "<button class='button' onclick='myFunction()'></button>"
    . "</div>"
    . "</div>";

echo "<div class='article'"
     . "<div class='container'>"
     . "<div class='description'>" . $produit->getDescription() . "</div>"
     . "</div>"
     . "</div>";
?>

</div>

</body>

</html>