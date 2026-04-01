<?php
    namespace App\Entity;
    use App\Utils\Hydrator;
    class Quete{
        public int $num_quete;
        public string $nom ;
        use Hydrator;
        public function __construct(array $data = []){
            $this->hydrate($data);
        }
        public function setNumQuete(int $num_quete){$this->num_quete = $num_quete;}
        public function getNumQuete() {return $this->num_quete;}
        public function setNom(string $nom){$this->nom = $nom;}
        public function getNom() {return $this->nom;} 
    }