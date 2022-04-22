<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Jeu de <?php
        if(isset($_SESSION['pseudo'])) {echo $_SESSION['pseudo'];}
        else echo "Guest";?></title>
</head>
<body>

<?php
foreach ($tab_p as $produit) {


    echo "<img src='view/images/".$produit->getPhoto()."/1.png' class='image' alt=" . "texte alternatif" . " title=" . "Titre de l'image/>"

        . "<div class='titre'>" . $produit->getNom() . "</div>"
        . $produit->getDescription() . '</p>';

}

//<p> Livre n°'. $produit->getId() . '</p>'
?>

</body>

</html>