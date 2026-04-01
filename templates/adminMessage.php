<?php
use App\Repository\RelationCQERepository;

$repo = new RelationCQERepository;
$messages = $repo->getMessage();

?>

    <a class='aAdmin' href="index.php?page=admin">retour</a>
    <h1 style="color: goldenrod; text-align: center; height: fit-content;">Tous les messages</h1>
    
    <table style="background-image: url('image/fondbandeausocial.png');  color: goldenrod; width: 90%;">
    <thead> <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Titre</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($messages as $message) : ?>
        <tr style="text-align: center; height: 50px;">
            <td><?= $message->getIdMessage() ?></td>
            <td><?= htmlspecialchars($message->getPseudo()) ?></td>
            <td><?= htmlspecialchars($message->getEmail()) ?></td>
            <td><?= htmlspecialchars($message->getTitre()) ?></td>
            <td id="tdMessage"><?= nl2br(htmlspecialchars($message->getTexte())) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
</table>
        </tbody>
    </table>
