<?php
use App\Repository\RelationCQERepository;
$repo = new RelationCQERepository();
$quetes = $repo->getNbJoueur();
?>
<div>
    <a class="aAdmin" href="index.php?page=admin">retour</a>
    <h1 style="color: goldenrod; text-align: center;">Toutes les Quetes</h1>
    
    <table style="background-image: url('image/fondbandeausocial.png'); margin-right: 50px; color: goldenrod; ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>est fini ?</th>
                <th>nb joueur Commencées</th>
                <th>nb joueur Commencées Terminées</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($quetes as $quete) : ?>
                    <tr style="text-align: center;">
                        <td><?= $quete->getId() ?></td>
                        <td><?= htmlspecialchars($quete->getNom()) ?></td>
                        <td><?= htmlspecialchars($quete->getDescription()) ?></td>
                        <td><?= $quete->getStatut() == 1 ? 'Oui' : 'Non' ?></td>            
                        <td><?= $quete->getNbJCommencee() ?></td>
                        <td><?= $quete->getNbJTerminee() ?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>