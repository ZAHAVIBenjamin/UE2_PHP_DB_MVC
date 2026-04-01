<?php 
  use App\Database;
  
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="index.js" defer></script>
    <link
      id="favIcone"
      rel="shortcut icon"
      href="image/logosansfond_5.png"
      type="image/x-icon"
    />
    <title>inscription</title>
  </head>
  <body>
    <main id="mainInscription">
      <div id="inscriptions"><?php include_once('formulaireInscription.php');?></div>
    </main>
  </body>
</html>