<?php 
namespace App\Repository;

use App\Database;
use App\Entity\Chasseur;
use PDO;

class ChasseurRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createChasseur($pseudo, $mdpHash): int|bool {
        $sql = "INSERT INTO chasseur (pseudo, mdp) VALUES (:pseudo, :mdp)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute(['pseudo' => $pseudo, 'mdp' => $mdpHash]);
        if ($success) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function findAll(): array {
        $sqlAllP = "SELECT numChasseur, pseudo, nom, prenom, email, phone, newsLetter, id_role 
                    FROM chasseur";
        $exec = $this->conn->query($sqlAllP);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);
        $chasseurs = [];
        foreach ($result as $row) {
            array_push($chasseurs, new Chasseur($row));
        }
        return $chasseurs;
    }

    public function findId(int $id): ?Chasseur {
        $sqlIdP = "SELECT numChasseur, pseudo, nom, prenom, email, phone, newsLetter, id_role 
                   FROM chasseur WHERE numChasseur = :id";
        $stmt = $this->conn->prepare($sqlIdP);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Chasseur($result);
        }
        return null;
    }

    public function getVerifMdp($pseudo, $mdp) {
    $sql = "SELECT numChasseur, pseudo, mdp, nom, prenom, email, phone, newsLetter, id_role 
                FROM chasseur 
                WHERE pseudo = :pseudo";
            
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['pseudo' => $pseudo]);
    $chasseurData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($chasseurData && password_verify($mdp, $chasseurData['mdp'])) {
        return new Chasseur($chasseurData);
    }
    return null;
}

    public function adherer(int $numChasseur, bool $choix) {
        $sql = "UPDATE chasseur SET newsLetter = :statut WHERE numChasseur = :id"; 
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['statut' => (int)$choix,'id' => $numChasseur]);
    }

    
}