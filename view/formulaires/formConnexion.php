<html>
<head>
    <title>Formulaire Connexion</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="view/CSS/index.css">
</head>
<body>
<form method="POST" action="<?php echo './index.php?controller=ControllerUtilisateur&action=connexion_Utilisateur' ?>" >
    <fieldset>
        <div class="containerC">
            <div class="headForm">
                <h1><i class="Titre" aria-hidden="true"></i> Connexion </h1>

            </div>
            <br/><br/>

            <div class="input-group">

            <label for="mail" class="label">Mail</label>
            <input type="text" class="form-control" placeholder="utilisateur.gmail.com" name="mail" id="mail" required>

            </div>
            <br/>

            <div class="input-group">
            <label for="mdp" class="label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" required/>

            </div>
            <br/>
            <br/>
            <input type="submit" class="btnConnection" value="Je me connecte" />
    </fieldset>
</form>

</body>

</html>