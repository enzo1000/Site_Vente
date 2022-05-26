<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/index.css">
    <script src="js/jquery.js"></script>
</head>
<body>
    <div>
        <p id="traitement">Veuillez patientez, votre femme est en train de valider votre commande...</p>
    </div>
</body>

<script>
    $(document).ready(function () {
        let start = Date.now(); // mémoriser l'heure de début

        let timer = setInterval(function () {
// combien de temps s'est écoulé depuis le début ?
            let timePassed = Date.now() - start;

            if (timePassed >= 2000) {
                clearInterval(timer); // terminer l'animation après 2 secondes
                $("p").remove("#traitement");
                $("div").append("<p>Félicitation ! Elle a validé votre panier et en plus...</p>"+
                "<p>Elle vous a payé tous les livres !!!</p>"+
                " <div><a href='../index.php?controller=ControllerCommande&action=gererPdf'> Télécharger votre facture</a> </div>"+
                " <div><a href='../index.php?controller=ControllerCommande&action=retourPageAccueil'>Retourner à librairie</a> </div>");
                return;
            }

        }, 20);
    });
</script>

</html>