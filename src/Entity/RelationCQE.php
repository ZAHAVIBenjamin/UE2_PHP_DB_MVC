<?php
    namespace App\Entity;
    use App\Utils\Hydrator;
    use DateTime;
    use PDO;

    class RelationCQE{
        public int $numChasseur;
        public int $num_quete;
        public int $id_etat ;
        public DateTime $date_mise_en_panier ;
        public ?DateTime $date_d_achat = null ;
        public ?DateTime $date_de_commencement_de_la_quete = null;
        public ?DateTime $date_de_fin_de_la_quete = null;
        use Hydrator;
        public function __construct(array $data = []){
            $this->hydrate($data);
        }
        public function setnumChasseur(int $numChasseur){$this->numChasseur = $numChasseur;}
        public function getnumChasseur() {return $this->numChasseur;}
        public function setNumQuete(int $num_quete){$this->num_quete = $num_quete;}
        public function getNumQuete() {return $this->num_quete;}
        public function setIdEtat(int $id_etat){$this->id_etat = $id_etat;}
        public function getIdEtat() {return $this->id_etat;}
        public function setDateMiseEnPanier(DateTime $date_mise_en_panier){$this->date_mise_en_panier = $date_mise_en_panier;}
        public function getDateMiseEnPanier() {return $this->date_mise_en_panier;}

        public function setDateDAchat(?DateTime $date_d_achat){$this->date_d_achat = $date_d_achat;}
        public function getDateDAchat() {return $this->date_d_achat;}

        public function setDateDeCommencementDeLaQuete(?DateTime $date_de_commencement_de_la_quete){$this->date_de_commencement_de_la_quete = $date_de_commencement_de_la_quete;}
        public function getDateDeCommencementDeLaQuete() {return $this->date_de_commencement_de_la_quete;}

        public function setDateDeFinDeLaQuete(?DateTime $date_de_fin_de_la_quete){$this->date_de_fin_de_la_quete = $date_de_fin_de_la_quete;}
        public function getDateDeFinDeLaQuete() {return $this->date_de_fin_de_la_quete;}


        
}