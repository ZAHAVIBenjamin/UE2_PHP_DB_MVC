<?php if (isset($erreur)): ?>
    <div style="color: red;"><?= htmlspecialchars($erreur); ?></div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <script src="index.js" defer></script>
    <title>login</title>
</head>
<body class="bodyLogin">
    <img id="imageLog" src="image/lorthanPortrait.png" alt="portrait de lorthan">
    <h1 class="titreLog">Bienvenue Chez Lorthan Le Fabuleux</h1>
    <h2 class="titreLog">Connectez-vous ou inscrivez-vous Aventurier</h2>
    <form id="formLog" method="post" action="index.php?page=login"> 
        <input class="inputLog" type="text" name="Pseudo" placeholder="Pseudo" required>  
        <input class="inputLog" type="password" name="mdp" placeholder="Mot de passe" required>
        <input class="bouttonSocial" type="submit" value="Valider">
        <a class="bouttonSocial" href="index.php?page=inscription">S'Inscrire</a>
    </form>
</body>
</html>
