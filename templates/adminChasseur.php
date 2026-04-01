<?php
use App\Repository\RelationCQERepository;

$repo = new RelationCQERepository;
$chasseurs = $repo->getNbQuete();

?>
<div>
    <a class="aAdmin" href="index.php?page=admin">retour</a>
    <h1 style="color: goldenrod; margin-left: 50px; text-align: center;">Tous les joueurs</h1>
    
    <table style="background-image: url('image/fondbandeausocial.png'); margin-right: 50px; color: goldenrod; ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Adhérant</th>
                <th>Quêtes Commencées</th>
                <th>Quêtes Terminées</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($chasseurs as $chasseur) : ?>
            <tr style="text-align: center;">
                <td><?= $chasseur->getNumChasseur() ?></td>
                <td><?= htmlspecialchars($chasseur->getPseudo()) ?></td>
                <td><?= htmlspecialchars($chasseur->getNom()) ?></td>
                <td><?= htmlspecialchars($chasseur->getPrenom()) ?></td>
                <td><?= htmlspecialchars($chasseur->getEmail()) ?></td>
                <td><?= $chasseur->getNewsLetter() ? 'Oui' : 'Non' ?></td>               
                <td><?= $chasseur->getNbQueteCommencee() ?></td>
                <td><?= $chasseur->getNbQueteTerminee() ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>