<?php 
  use App\Repository\RelationCQERepository;
  use App\Utils\AfficheurQuete;

  $idChasseur = $_SESSION['user_id'] ?? null;
  $relationRepo = new RelationCQERepository();
  $quetes = $idChasseur ? $relationRepo->getQuetesBoutique((int)$idChasseur) : [];
?>
<h2 style="color: goldenrod; text-align: center;">Boutique</h2>
<div id="boutiqueCorp">
  <img id="boutiqueImg" src="image/imageBoutique.png" alt="image de LORTHAN"/>
  <div id="hautDeBoutique">
    <?php foreach($quetes as $quete): ?>
      <?= AfficheurQuete::renderCardBoutique($quete); ?> 
    <?php endforeach; ?>
  </div>
</div>