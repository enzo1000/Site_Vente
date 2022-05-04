<html>
<head>
    <title>Formulaire Inscription</title>
    <meta charset="utf-8" />
</head>
<body>
<form method="POST" action="<?php echo './index.php?controller=ControllerUtilisateur&action=inscription_Utilisateur' ?>">
    <fieldset>
        <legend>Inscription :</legend>
        <p>
            <label for="mail">Mail</label> :
            <input type="text" placeholder="utilisateur.gmail.com" name="mail" id="mail">
        </p>
        <p>
            <label for="nom">Nom</label> :
            <input type="text" placeholder="nom utilisateur" name="nom" id="nom" required/>
        </p>
        <p>
            <label for="prenom">Prénom</label> :
            <input type="text" placeholder="prénom utilisateur" name="prenom" id="prenom" required/>
        </p>
        <p>
            <label for="mdp">Mot de passe</label> :
            <input type="password" placeholder="1234" name="mdp" id="mdp" required/>
        </p>
        <p>
            <label for="mdp2">Vérifier mot de passe</label> :
            <input type="password" placeholder="1234" name="mdp2" id="mdp2" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>

</html>