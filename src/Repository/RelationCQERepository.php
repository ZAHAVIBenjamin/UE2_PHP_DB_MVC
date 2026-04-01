<?php

namespace App\Repository;

use App\Database;
use PDO;
use App\Entity\Chasseur;
use App\Entity\Quete;
use App\Entity\Message;

class RelationCQERepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    public function getAllQuetesNames(): array {
        $sql = "SELECT nom FROM quete";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function ChangeStatut(int $id, int $nouveauStatut): bool {
        $sql = "UPDATE quete SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'statut' => $nouveauStatut,
            'id' => $id
        ]);
    }

   
    // LOGIQUE BOUTIQUE (ÉTAT 0)
 
    public function getQuetesBoutique(int $idChasseur): array {
        $sql = "SELECT q.*, r.id_etat 
                FROM quete q 
                LEFT JOIN relation_chasseur_quete r 
                ON q.id = r.num_quete AND r.numChasseur = :id";             
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $idChasseur]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Entity\Quete');
    }

    //  LOGIQUE AJOUTER PANIER (ÉTAT 0 A 1)

    public function ajouterAuPanier(int $numChasseur, int $numQuete): bool {
        $sqlCheck = "SELECT COUNT(*) FROM relation_chasseur_quete 
                     WHERE numChasseur = :chasseur AND num_quete = :quete";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([
            'chasseur' => $numChasseur,
            'quete' => $numQuete
        ]);

        if ($stmtCheck->fetchColumn() > 0) {
            return false; 
        }
        $sql = "INSERT INTO relation_chasseur_quete (numChasseur, num_quete, id_etat, date_mise_en_panier) 
                VALUES (:chasseur, :quete, 1, NOW())"; 

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'chasseur' => $numChasseur,
            'quete' => $numQuete
        ]);
    }

    //  LOGIQUE PANIER (ÉTAT 1)

    public function getPanier(int $idChasseur): array {
        $sql = "SELECT q.* FROM quete q 
                JOIN relation_chasseur_quete r ON q.id = r.num_quete 
                WHERE r.numChasseur = :id AND r.id_etat = 1";       
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $idChasseur]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Entity\Quete');
    }

    //  LOGIQUE RETIRER PANIER (ÉTAT 1 A 0)

    public function retirerDuPanier(int $numChasseur, int $numQuete): bool {
        $sql = "DELETE FROM relation_chasseur_quete 
                WHERE numChasseur = :chasseur AND num_quete = :quete AND id_etat = 1"; 
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['chasseur' => $numChasseur, 'quete' => $numQuete]);
    }

    //  LOGIQUE PAYER (PASSAGE ÉTAT 1 -> 2)

    public function payer(int $numChasseur): bool {
        // On valide tout ce qui est dans le panier (1) pour le passer en acheté (2)
        $sql = "UPDATE relation_chasseur_quete 
                SET id_etat = 2, date_d_achat = NOW() 
                WHERE numChasseur = :numChasseur AND id_etat = 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['numChasseur' => $numChasseur]);
    }

    //  LOGIQUE PROFIL (ÉTATS 2)

    public function getProfil(int $idChasseur): array {
        $sql = "SELECT q.* FROM quete q 
                JOIN relation_chasseur_quete r ON q.id = r.num_quete 
                WHERE r.numChasseur = :id AND r.id_etat >= 2";       
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $idChasseur]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Entity\Quete');
    }
    public function getTresor(int $idChasseur): array {
        $sql = "SELECT q.*, r.id_etat 
            FROM quete q
            LEFT JOIN relation_chasseur_quete r ON q.id = r.num_quete AND r.numChasseur = :id";         
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $idChasseur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  LOGIQUE TRESOR (ÉTATS 2 A 3)

    public function commencer(int $numChasseur, int $idQuete): bool {
        $sql = "UPDATE relation_chasseur_quete 
                SET id_etat = 3, date_de_commencement_de_la_quete = NOW() 
                WHERE numChasseur = :numChasseur 
                AND num_quete = :idQuete 
                AND id_etat = 2";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['numChasseur' => $numChasseur,'idQuete' => $idQuete]);
    }

    // LOGIQUE ADMIN
    public function getNbQuete() {
    $sql = "SELECT c.numChasseur, c.pseudo, c.nom, c.prenom, c.email, c.newsLetter, 
                   COUNT(r.date_de_commencement_de_la_quete) as nb_quete_commencee, 
                   COUNT(r.date_de_fin_de_la_quete) as nb_quete_terminee
            FROM chasseur c
            LEFT JOIN relation_chasseur_quete r ON r.numChasseur = c.numChasseur
            GROUP BY c.numChasseur";
    $exec = $this->conn->query($sql);
    $result = $exec->fetchAll(PDO::FETCH_ASSOC);      
    $chasseurs = [];
    foreach ($result as $row) {
        $chasseurs[] = new Chasseur($row);
    }
    return $chasseurs;
}
    public function getNbJoueur(): array {
        $sql = "SELECT q.id, q.nom, q.description, q.statut,
                   COUNT(r.date_de_commencement_de_la_quete) AS nb_j_commencee, 
                   COUNT(r.date_de_fin_de_la_quete) AS nb_j_terminee
                FROM quete q
                LEFT JOIN relation_chasseur_quete r ON r.num_quete = q.id
                GROUP BY q.id";

        $exec = $this->conn->query($sql);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);    
        $quetes = [];
        foreach ($result as $row) {
            $quetes[] = new Quete($row);
        }
        return $quetes;
    }

    public function getMessage(){
        $sql = "SELECT m.id_message,c.pseudo, c.email, m.titre,m.texte
                FROM message as m JOIN chasseur as c ON c.numChasseur=m.numChasseur";
        $exec = $this->conn->query($sql);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);    
        $messages = [];
        foreach ($result as $row) {
            $messages[] = new Message($row);
        }
        return $messages;
    }

}