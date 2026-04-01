<?php
namespace App\Entity;

use App\Utils\Hydrator;

class Quete {
    public int $id;
    public string $nom;
    public string $description;
    public ?int $statut = null;
    public string $composition_tresor;  
    public float $prix;
    public ?int $numChasseur = null;
    public ?int $id_etat = null;
    public int $nbJCommencee = 0;
    public int $nbJTerminee = 0;

    use Hydrator;

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function setId(int $id) { $this->id = $id; }
    public function getId(): int { return $this->id; }

    public function setNom(string $nom) { $this->nom = $nom; }
    public function getNom(): string { return $this->nom; }

    public function setDescription(string $description) { $this->description = $description; }
    public function getDescription(): string { return $this->description; }

    public function setStatut(?int $statut) { $this->statut = $statut; }
    public function getStatut(): ?int { return $this->statut; }

    public function setCompositionTresor(string $composition_tresor) {$this->composition_tresor = $composition_tresor;
    }
    public function getCompositionTresor(): string { return $this->composition_tresor; }

    public function setPrix(float $prix) { $this->prix = $prix; }
    public function getPrix(): float { return $this->prix; }

    public function setNumChasseur(?int $numChasseur) { $this->numChasseur = $numChasseur; }
    public function getNumChasseur(): ?int { return $this->numChasseur; }

    public function setIdEtat(?int $id_etat) { $this->id_etat = $id_etat; }
    public function getIdEtat(): ?int { return $this->id_etat; }

    public function setNbJCommencee(int $nb) { $this->nbJCommencee = $nb; }
    public function getNbJCommencee(): int { return $this->nbJCommencee; }

    public function setNbJTerminee(int $nb) { $this->nbJTerminee = $nb; }
    public function getNbJTerminee(): int { return $this->nbJTerminee; }
}