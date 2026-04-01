<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <script src="/public/index.js" defer></script>
        <link
          id="favIcone"
          rel="shortcut icon"
          href="image/logosansfond_5.png"
          type="image/x-icon"
        />
        <title>
    <?php
    switch($page) {
        case 'profil': echo "Profil"; break;
        case 'chasseautresor': echo "Chasse aux trésor"; break;
        case 'boutique': echo "Boutique"; break;
        case 'option': echo "Option"; break;
        case 'contact': echo "Contact"; break;
        default: echo "Page d'accueil"; break;
    }
    ?>
</title>
    </head>