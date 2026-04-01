<?php 
namespace App\Utils;

use App\Entity\Quete;


class AfficheurQuete {
   public static function renderCardBoutique($quete) {
    $prix = number_format($quete->getPrix(), 2);
    $nom = $quete->getNom();
    $tresor = $quete->getCompositionTresor();
    $id = $quete->getId();

    $html = "<table id='tableBoutique'>
                <tr><td id='tdNom' colspan='2'><h2>{$nom}</h2></td></tr>
                <tr><td colspan='2'><img id='imageParchemin' src='image/parchemin.png' alt='Parchemin'/></td></tr>
                <tr>
                    <td id='tdPrix'>Prix : $prix €</td>
                    <td id='tdButin'>A gagner : {$tresor}</td>
                </tr>";

    $html .= "<tr><td colspan='2' style='text-align:center; padding:10px;'>";
    if ($quete->getIdEtat() === null) {
        $html .= "<form id='formAjoute' method='POST' action='index.php?page=boutique'>
                    <input type='hidden' name='id' value='{$id}'>
                    <button id='bouttonAjoute' type='submit' name='action' value='ajouter' class='bouttonGo'>Ajouter au panier</button>
                  </form>";
    } else {
        $html .= "<span class='indisponible' style='color:red; font-weight:bold;'>Déjà acquise ou au panier</span>";
    }

    $html .= "</td></tr></table>";
    
    return $html;
}
    public static function renderCardPanier(Quete $quete): string {
    $prix = number_format($quete->getPrix(), 2);
    $html = "<table id='tableBoutique'>
                <tr><td id='tdNom' colspan='2'><h2>{$quete->getNom()}</h2></td></tr>
                <tr><td colspan='2'><img id='imageParchemin' src='image/parchemin.png'/></td></tr>
                <tr>
                    <td id='tdPrix'>Prix : $prix €</td>
                    <td id='tdButin'>A gagner : {$quete->getCompositionTresor()}</td>
                </tr>";
            $html .= "<tr>
                        <td colspan='2'>
                            <form method='post' action='index.php?page=panier'>
                                <input type='hidden' name='id' value='{$quete->getId()}'>
                                <button type='submit' name='action' value='retirer'>Retirer</button>
                            </form>
                        </td>
                    </tr>";

    $html .= "</table>";
    return $html;
}
    public static function renderCardPofil(Quete $quete): string {
    $nom = $quete->getNom();
    $tresor = $quete->getCompositionTresor();
    $html = "<table id='tableBoutique'>
                <tr>
                    <td id='tdNom' colspan='2'>
                        <h2>{$nom}</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <img id='imageParchemin' src='image/parchemin.png' alt='Parchemin'/>
                    </td>
                </tr>
                <tr>
                    <td id='tdButin' colspan='2'>
                        <strong>Butin :</strong> {$tresor}
                    </td>
                </tr>
            </table>";
    return $html;
}

    public static function renderCardTresor(array $quete): string {
        $nom = $quete['nom'];
        $idQuete = $quete['id'];
        $composition = $quete['composition_tresor'];
        $etat = $quete['id_etat'];
        $nom = str_replace(' ', '',$nom);
        $boutonTexte = 'Commencer';
        if($etat == 3){
        $boutonTexte = 'Continuer';
        }
    
    $html = "<table id='tableBoutique'>
                <tr><td id='tdNom' colspan='2'><h2>" . htmlspecialchars($nom) . "</h2></td></tr>
                <tr><td colspan='2'><img id='imageParchemin' src='image/parchemin.png'/></td></tr>
                <tr>
                    <td id='tdButin' colspan='2'>A gagner : " . htmlspecialchars($composition) . "</td>
                </tr>";

    $html .= "<tr><td colspan='2' style='text-align:center;'>";

    if ($etat === null || $etat == 1) {
        $html .= "<p style='color:orange; font-size:0.8em;'>Contenu verrouillé</p>";
        $html .= "<a class='bouttonSocial' href='index.php?page=boutique'>Acheter le parchemin</a>";
    } else {
        $boutonTexte = ($etat == 3) ? 'Continuer' : 'Commencer';
        
        $html .= "<form method='post' action='index.php?page={$nom}'>
                    <input type='hidden' name='id' value='{$idQuete}'>
                    <button type='submit' name='action' value='commencer' >{$boutonTexte}</button>
                  </form>";
    }

    $html .= "</td></tr></table>";
    return $html;
}
}

