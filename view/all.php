<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view/CSS/index.css">

    <title>Jeu de <?php
        if (isset($_SESSION['pseudo'])) {
            echo $_SESSION['pseudo'];
        } else echo "Guest"; ?></title>
</head>
<body>

<?php require_once File::build_path(array("view", "header.php")); ?>

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
            . "<a href=''>" . $produit->getNom() . "</a>"
            . "</div>"
            . "<div class='prix'>" . $produit->getPrix() . " €</div>"
            . "<div class='description'>" . $produit->getDescription() . "</div>"
            ."<button class='like button' id='".$produit->getId() . "'onclick='myFunction(".$produit->getId() . ")'></button>"
            ."<button class='button' onclick='myFunction()'></button>"
            ."</div>"
            ."</div>";

    }
    ?>


    <script type="text/javascript">


        function myFunction(id){
            console.log(id);
        document.getElementById(id).style.backgroundColor = "#FEEBEA";
        document.getElementById(id).style.backgroundImage = "url('view/images/logo_coeur_active.png')";
        }
    </script>

</div>

</body>

</html>