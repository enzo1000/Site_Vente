<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="<?php echo File::build_path(array("view","CSS","index.css"))?>"-->
    <link rel="stylesheet" href="view/CSS/index.css">
    <title>Jeu de <?php
        if (isset($_SESSION['pseudo'])) {
            echo $_SESSION['pseudo'];
        } else echo "Guest"; ?></title>
</head>
<body>
<div class='liste'>
<?php
foreach ($tab_p as $produit) {


    echo  "<div class='ligne'>"
        . "<div class='article'>"
        . "<div class='image'>"
        . "<img src='view/images/" . $produit->getPhoto() . "/1.png' class='image' alt=" . "texte alternatif" . " title=" . "Titre de l'image/>"
        . "</div>"
        . "<div class='titre'>" . $produit->getNom() . "</div>"
        . "<div class='prix'>" . $produit->getPrix() . "</div>"
        . "<div class='description'>" . $produit->getDescription() . "</div>"
        . "</div>"
        . "</div>";

}


//<p> Livre n°'. $produit->getId() . '</p>'
?>
</div>

</body>

</html>