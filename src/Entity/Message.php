<?php
    namespace App\Entity;
    use App\Utils\Hydrator;

    class Message{
        public int $id_message;
        public string $titre ;
        public string $texte;
        public int $numChasseur;

        public string $pseudo = ""; 
        public string $email = "";
        use Hydrator;
        public function __construct(array $data = []){
            $this->hydrate($data);
        }
        public function setidMessage(int $id_message){$this->id_message = $id_message;}
        public function getidMessage() {return $this->id_message;}
        public function setTitre(string $titre){$this->titre = $titre;}
        public function getTitre() {return $this->titre;}
        public function setTexte(string $texte){$this->texte = $texte;}
        public function getTexte() {return $this->texte;}
        public function setnumChasseur(int $numChasseur){$this->numChasseur = $numChasseur;}
        public function getnumChasseur() {return $this->numChasseur;}
        public function setPseudo(string $pseudo){$this->pseudo = $pseudo;}
        public function getPseudo() {return $this->pseudo;}

        public function setEmail(string $email){$this->email = $email;}
        public function getEmail() {return $this->email;}
    }