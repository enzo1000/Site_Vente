<html>
<head>
    <title>Formulaire Inscription</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="view/CSS/index.css">
</head>
<body>
<form method="POST" action="<?php echo './index.php?controller=ControllerUtilisateur&action=inscription_Utilisateur' ?>">
    <fieldset>
        <div class="containerC">
            <div class="headForm">
                <h1><i class="Titre" aria-hidden="true"></i> Inscription </h1>
            </div>
            <br/><br/>

            <div class="input-group">

            <label for="mail" class="label">Mail</label>
            <input type="text" class="form-control" placeholder="utilisateur.gmail.com" name="mail" id="mail">
            </div>
            <br/>

            <div class="input-group">

            <label for="nom" class="label">Nom</label>
            <input type="text" class="form-control" placeholder="nom utilisateur" name="nom" id="nom" required/>
            </div>
            <br/>

            <div class="input-group">
            <label for="prenom" class="label">Prénom</label>
            <input type="text" class="form-control" placeholder="prénom utilisateur" name="prenom" id="prenom" required/>
            </div>
            <br/>

            <div class="input-group">
            <label for="mdp" class="label">Mot de passe</label>
            <input type="password" class="form-control" placeholder="1234" name="mdp" id="mdp" required/>
            </div>
            <br/>

            <div class="input-group">
            <label for="mdp2" class="label">Vérifier mot de passe</label>
            <input type="password" class="form-control" placeholder="1234" name="mdp2" id="mdp2" required/>

            </div>
            <br/>
            <br/>
            <input type="submit" class="btnConnection" value="Envoyer" />

    </fieldset>
</form>

</body>

</html>