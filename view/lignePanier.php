<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="<?php //echo File::build_path(array("view","CSS","index.css"))?>"-->
    <link rel="stylesheet" href="view/CSS/index.css">

    <title>Bienvenue <?php
        if (isset($_SESSION['pseudo'])) {
            echo $_SESSION['pseudo'];
        } else echo "Guest"; ?></title>
</head>
<body>

<div class='liste'>

    <?php
    ?>

</div>

</body>

</html>