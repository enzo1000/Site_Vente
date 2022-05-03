<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="<?php //echo File::build_path(array("view","CSS","index.css"))?>"-->
    <link rel="stylesheet" href="view/CSS/index.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.0.0/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    <title>Jeu de <?php
        if (isset($_SESSION['pseudo'])) {
            echo $_SESSION['pseudo'];
        } else echo "Guest"; ?></title>
</head>
<body>

<div class='liste'>

    <?php
    foreach ($tab_p as $produit) {

        echo "<div class='article'>"
            ."<div class='container'>"
            . "<div class='image'>"
            . "<img src='view/images/" . $produit->getPhoto() . "/1.png' class='image' alt=" . "texte alternatif" . " title=" . "Titre de l'image/>"
            . "</div>"
            . "<div class='titre'>"
            . "<a href=''>" . $produit->getNom() . "</a>"
            . "</div>"
            . "<div class='prix'>" . $produit->getPrix() . " €</div>"
            . "<div class='description'>" . $produit->getDescription() . "</div>"
            /*
            . "<button type='button' class='btn btn-info btn-circle btn-lg'><i class='glyphicon glyphicon-ok'></i></button>"
            . "<button type='button' class='btn btn-danger btn-circle btn-lg'><i class='glyphicon glyphicon-heart'></i></button>"
            */
            ."<button class='like'></button>"
            ."</div>"
            ."</div>";

    }
    ?>

</div>

</body>

</html>