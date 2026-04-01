<?php 
  use App\Repository\RelationCQERepository;
  use App\Utils\AfficheurQuete;
  $relationRepo = new RelationCQERepository();
  $idChasseur = $_SESSION['user_id'] ?? 0;
  $quetesSelectionnees = $relationRepo->getTresor($idChasseur);
?>
<h2 style="color: goldenrod; text-align: center;">Tresor</h2>
<div id="chasseCorp">
  <img
    id="chasseImage"
    src="image/chasseImage.png"
    alt="image de lorthan"
  />
  <div id="chasseDiv">
    <?php foreach($quetesSelectionnees as $quete): ?>
      <?= AfficheurQuete::renderCardTresor($quete); ?>
    <?php endforeach; ?>
  </div>
</div>


   