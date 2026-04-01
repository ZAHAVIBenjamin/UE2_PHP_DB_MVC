 <?php
  use App\Repository\RelationCQERepository;
  use App\Utils\AfficheurQuete;
  $relationRepo = new RelationCQERepository();
  $idChasseur = $_SESSION['user_id'] ?? 0;
  $quetesSelectionnees = $relationRepo->getProfil($idChasseur);
?>
<h2 style="color: goldenrod; text-align: center;">Profil</h2>
<h3 style="color: goldenrod; text-align: center;">liste de vos parchemin d'entrée</h3>
<div id="profile1">
  <img
    id="profileimage"
    src="image/profilImage.png"
    alt="image de LORTHAN"
  />
  <div id="profilDiv">
    <?php foreach($quetesSelectionnees as $quete): ?>
      <?= AfficheurQuete::renderCardPofil($quete); ?>
    <?php endforeach; ?>
  </div>
</div>
 