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
            ."<div class='container'>"
            . "<div class='image'>"
            . "<img src='view/images/" . $produit->getPhoto() . "/1.png' class='image' alt=" . "Produit_" . $produit->getId() . " title=" . $produit->getId() . ">"
            . "</div>"
            . "<div class='titre'>"
            . "<a href=./index.php?controller=ControllerProduit&action=read_Produit&param=" . $produit->getId() . ">" . $produit->getNom() . "</a>"
            . "</div>"
            . "<div class='prix'>" . $produit->getPrix() . " €</div>"
            . "<div class='description'>" . $produit->getDescription() . "</div>"
            ."<button class='like button' id='like:".$produit->getId() . "' onclick='addlike(id)';></button>"
            ."<button class='add button' id='add:".$produit->getId() . "'onclick='addtocart(id)';></button>"
            ."<a href='index.php?controller=ControllerLignePanier&param=" . $produit->getId() . "&action=add_LignePanier'><button>+</button></a>"
            . "<a href='index.php?controller=ControllerLignePanier&param=" . $produit->getId() . "&action=remove_LignePanier'><button>-</button></a>";



            if (isset($_SESSION['panier2'])){
                foreach ($_SESSION['panier2'] as $index => $produit){
                    $qte = $produit['qte'];
                }
            }
            else
                $qte = 0;

            echo "<input type='text' value=".$qte." size='1'>"
                ."</div>"
                ."</div>";


    }
    ?>


    <script type="text/javascript">


        function addlike(id){
            document.getElementById(id).style.backgroundColor = "#FEEBEA";
            document.getElementById(id).style.backgroundImage = "url('view/images/logo_coeur_active.png')";
        }

        function addtocart(id){
            document.getElementById(id).style.backgroundColor = "#3BAD27";
            document.getElementById(id).style.backgroundImage = "url('view/images/logo_panier_active.png')";
        }
    </script>

</div>

</body>

</html>