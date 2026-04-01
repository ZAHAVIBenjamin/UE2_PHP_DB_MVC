<?php 
  use App\Repository\RelationCQERepository;
  use App\Utils\AfficheurQuete;

  $relationRepo = new RelationCQERepository();
  $idChasseur = $_SESSION['user_id'];
  $quetesSelectionnees = $relationRepo->getPanier($idChasseur);
?>
<div id="produitsList"> 
  <?php if (empty($quetesSelectionnees)): ?>
      <p style="color:goldenrod; text-align:center; width:100%;">Aucune Quete dans le Panier...</p>
  <?php else: ?>
      <?php 
      $total = 0;
      foreach($quetesSelectionnees as $quete): 
          $total += $quete->getPrix();
          echo AfficheurQuete::renderCardPanier($quete); 
      endforeach; 
      ?>
      </div>
      <div class="panier-actions">
          <output>Total : <?= number_format($total, 2); ?> €</output>
          <form action="index.php?page=panier" method="post">
            <button class="bouttonSocial" type='submit' name='action' value='payer'>Payer</button>
          </form>
      
  <?php endif; ?>
</div>