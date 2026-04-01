<?php 
namespace App\Repository;

use App\Database;
use App\Entity\Quete;
use PDO;

class QueteRepository{

    private PDO $conn;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function findAll(): array{
        $sqlAllQ = "SELECT * FROM quete";
        $exec= $this->conn->query($sqlAllQ);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);
        $quetes = [];
        foreach($result as $row){
           array_push($quetes, new Quete($row));
        }
        
        return $quetes;
    }

    public function findId(int $id): ?Quete{
         
        $sqlIdP =  "SELECT * FROM quete WHERE id = :id";
        $stmt = $this->conn->prepare($sqlIdP);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        return new Quete($result);
        }
        else {
        return null;
        }
    }
    public function findDisponiblesPourChasseur(int $idChasseur): array {
    $sql = "SELECT * FROM quete 
            WHERE statut IS NULL 
            AND id NOT IN (
                SELECT num_quete FROM relation_chasseur_quete WHERE numChasseur = :id
            )";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $idChasseur]);
    
    return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Quete');
}
    
public function findAllAvecEtatPourChasseur(int $idChasseur): array {
    $sql = "SELECT q.*, r.id_etat as etat_joueur 
            FROM quete q
            LEFT JOIN relation_chasseur_quete r ON q.id = r.num_quete AND r.numChasseur = :id
            WHERE q.statut IS NULL";
            
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $idChasseur]);
    
    return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Quete');
}
}
