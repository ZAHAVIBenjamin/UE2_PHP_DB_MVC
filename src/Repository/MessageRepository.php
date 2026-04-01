<?php 

namespace App\Repository;

use App\Database;
use App\Entity\Message;
use PDO;

class MessageRepository{

    private PDO $conn;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function findAll(): array{
        $sqlAllM = "SELECT * FROM message";
        $exec= $this->conn->query($sqlAllM);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);
        $messages = [];
        foreach($result as $row){
           array_push($messages, new Message($row));
        }
        
        return $messages;
    }

    public function findId(int $id): ?Message{
         
        $sqlIdM =  "SELECT * FROM message WHERE id = :id_message";
        $stmt = $this->conn->prepare($sqlIdM);
        $stmt->bindParam(':id_message', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        return new Message($result);
        }
        else {
        return null;
        }
    }
    public function envoyerMessage(int $numChasseur, string $titre, string $texte): void{
        $sql = "INSERT INTO message (numChasseur, titre, texte) 
                VALUES (:numChasseur, :titre, :texte)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'numChasseur' => $numChasseur,
            'titre'       => $titre,
            'texte'       => $texte
        ]);
    }


}