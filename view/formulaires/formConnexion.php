<html>
<head>
    <title>Formulaire Connexion</title>
    <meta charset="utf-8" />
</head>
<body>
<form method="POST" action="<?php echo './index.php?controller=ControllerUtilisateur&action=connexion_Utilisateur' ?>" >
    <fieldset>
        <legend>Connexion :</legend>
        <p>
            <label for="mail">Mail</label> :
            <input type="text" placeholder="joueur.gmail.com" name="mail" id="mail" required>
        </p>
        <p>
            <label for="mdp">Mot de passe</label> :
            <input type="password" name="mdp" id="mdp" required/>
        </p>
        <p>
            <input type="submit" value="Je me connecte" />
        </p>
    </fieldset>
</form>

</body>

</html>