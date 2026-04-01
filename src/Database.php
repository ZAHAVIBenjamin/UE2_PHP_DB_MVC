<?php
namespace App;
use PDO;
use PDOException;
class Database{
    private string $host = "localhost";
    private string $db_name = "ue2";
    private string $username = "root";
    private string $password = "root";
    private static ?Database $_instance = null;
    private ?PDO $pdo = null;
    public static function getInstance(): Database{
        if(Database::$_instance ===null){
            Database::$_instance = new self();
        }
        return Database::$_instance;
    }


    public function __construct(){
        $dsn = "mysql:host=$this->host;dbname=$this->db_name";
        $connexion = null;
        try{
            $connexion = new PDO ( $dsn,  $this->username, $this->password);
            $connexion -> exec("SET NAMES utf8");
        } catch (PDOException $e){
            echo("erreur : ".$e->getMessage());
        }
        $this->pdo = $connexion;
    }

    public function getConnection(): PDO{
            return $this->pdo;  
    } 
}
?>
