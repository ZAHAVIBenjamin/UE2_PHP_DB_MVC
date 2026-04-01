<?php
    namespace App\Entity;
    use App\Utils\Hydrator;
    class EtatDQ{
        public int $id_etat;
        public string $nom_etat ;
        public string $description;
        
        use Hydrator;
        public function __construct(array $data = []){
            $this->hydrate($data);
        }

        public function setIdEtat(int $id_etat){$this->id_etat = $id_etat;}
        public function getIdEtat() {return $this->id_etat;}

        public function setNomEtat(string $nom_etat){$this->nom_etat = $nom_etat;}
        public function getNomEtat() {return $this->nom_etat;}
        public function setDescription(string $description){$this->description = $description;}
        public function getDescription() {return $this->description;}
       
    }