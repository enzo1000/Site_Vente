<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html class=''>
<head>
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/x-icon"
          href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico"/>
    <link rel="mask-icon" type=""
          href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg"
          color="#111"/>
    <link rel="canonical"
          href="https://codepen.io/nikhil8krishnan/pen/WvYPvv?depth=everything&limit=all&order=popularity&page=27&q=text&show_forks=false"/>

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <style class="cp-pen-styles">
        h1 {
            margin-top: 20px;
            font-size: 30px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .tbl-content {
            height: 70%;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body {
            background: -webkit-linear-gradient(left, #25c481, #25b7c4);
            background: linear-gradient(to right, #25c481, #25b7c4);
            font-family: 'Roboto', sans-serif;
        }


        /* follow me template */
        .made-with-love {
            display: none;
        }

        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        img {
            width: 15%;
        }

        button {
            margin: 20px;
        }
    </style>
</head>
<body>
<section>
    <!--for demo wrap-->
    <h1>Panier
        de <?php echo $_SESSION['ModelUtilisateur']['prenom'] . " " . $_SESSION['ModelUtilisateur']['nom'] ?></h1>
    <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
            <thead>
            <tr>
                <th>idLivre</th>
                <th>Nom</th>
                <th>Image</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>PrixTotal</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
            <?php
            $prixFinal = 0;
            foreach ($tabProduit as $produit) {
                $prixTot = $produit['prix'] * $produit['qte'];
                $prixFinal += $prixTot;
                echo "<tr>
                <td>{$produit['id']}</td>
                <td>{$produit['nom']} </td>
                <td><img src='view/images/" . $produit['photo'] . "/1.png' class='image' alt=" . "Produit_" . $produit['id'] . " title=" . $produit['id'] . "></td>
                <td>{$produit['prix']}</td>
                <td>{$produit['qte']}</td>
                <td>{$prixTot}</td>
            </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>


<!-- follow me template -->
<div class="made-with-love">
    Made with
    <i>♥</i> by
    <a target="_blank" href="https://codepen.io/nikhil8krishnan">Nikhil Krishnan</a>
</div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>// '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
    $(window).on("load resize ", function () {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right': scrollWidth});
    }).resize();
</script>

<section>
    <?php
    echo "<h1>";
    echo "<a href='index.php?controller=ControllerCommande&action=creerCommande_Commande&param=$prixFinal'>";
    echo "<button type='button'>";
    echo "Payer $prixFinal €";
    echo "</button>";
    echo "</a>";

    echo "<a href='index.php'>";
    echo "<button type='button'>";
    echo "Continuez vos achats";
    echo "</button>";
    echo "</a>";

    echo "</h1>";
    ?>
</section>

</body>
</html>