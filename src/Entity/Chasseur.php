<?php
    namespace App\Entity;
    use App\Utils\Hydrator;
    class Chasseur{
        public int $numChasseur; 
        public string $nom;
        public string $prenom;
        public string $email;
        public string $phone;
        public string $pseudo;
        public string $mdp;
        public bool $newsLetter;
        public int $id_role;
        public int $nbQueteCommencee = 0;
        public int $nbQueteTerminee = 0;
        use Hydrator;
        public function __construct(array $data = []){
            $this->hydrate($data);
        }
        public function setNumChasseur(int $numChasseur){$this->numChasseur = $numChasseur;}
        public function getNumChasseur() {return $this->numChasseur;}
        public function setNom(string $nom){$this->nom = $nom;}
        public function getNom() {return $this->nom;}
        public function setPrenom(string $prenom){$this->prenom =   $prenom;}
        public function getPrenom() {return $this->prenom;}
        public function setEmail(string $email){$this->email =  $email;}
        public function getEmail() {return $this->email;}
        public function setPhone(string $phone){$this->phone =  $phone;}
        public function getPhone() {return $this->phone;}
        public function setPseudo(string $pseudo){$this->pseudo = $pseudo;}
        public function getPseudo() {return $this->pseudo;}
        public function setMdp(string $mdp){$this->mdp = $mdp;}
        public function getMdp() {return $this->mdp;}
        public function setNewsLetter(bool $newsLetter) {$this->newsLetter = $newsLetter;}
        public function getNewsLetter() {return $this->newsLetter;}
        public function setIdRole(int $id_role){$this->id_role =    $id_role;}
        public function getIdRole() {return $this->id_role;}
        public function setNbQueteCommencee(int $nb) { 
        $this->nbQueteCommencee = $nb; 
        }
        public function getNbQueteCommencee(): int { 
        return $this->nbQueteCommencee; 
        }
        public function setNbQueteTerminee(int $nb) { 
        $this->nbQueteTerminee = $nb;
        }
        public function getNbQueteTerminee(): int { 
        return $this->nbQueteTerminee;
        }
    }