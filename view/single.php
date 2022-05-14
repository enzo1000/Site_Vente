<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view/CSS/index.css">
</head>

<?php require_once File::build_path(array("view", "header.php"));?>

<body>
<div class="contenu">
<div class="liste">

<?php
echo "<div class='article'>"
    . " Livre n°" . $produitSingle->getId()
    . "<div class='container'>"
    . "<div class='image'>"
    . "<img src='view/images/" . $produitSingle->getPhoto() . "/1.png' class='image' alt=" . "texte alternatif" . " title=" . "Titre de l'image/>"
    . "</div>"
    . "<div class='titre'>"
    . "<a href=./index.php?controller=ControllerProduit&action=read_Produit&param=" . $produitSingle->getId() . ">" . $produitSingle->getNom() . "</a>"
    . "</div>"
    . "<div class='prix'>" . $produitSingle->getPrix() . " €</div>"
    . "<button class='like button' id='" . $produitSingle->getId() . "'onclick='myFunction(" . $produitSingle->getId() . ")'></button>"
    . "<button class='button' onclick='myFunction()'></button>"
    . "</div>"
    . "</div>";

echo "<div class='article'"
     . "<div class='container'>"
     . "<div class='description'>" . $produitSingle->getDescription() . "</div>"
     . "</div>"
     . "</div>";
?>

</div>
</div>

</body>

</html>