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
        else echo "Guest"?></title>
</head>
<body>

<?php
    echo '<p> Voiture d\'immatriculation '
        . $produit->getNom() .
        $produit->getDescription() .'</p>';
?>

</body>

</html>