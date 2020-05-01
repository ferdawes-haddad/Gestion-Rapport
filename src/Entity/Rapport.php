<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepository")
 */
class Rapport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="Enseignant", inversedBy="rapports")
     */
    private $enseignants;

    /**
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy="rapports")
     */
    private $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity="Classe", inversedBy="rapports")
     */
    private $classes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnseignants()
    {
        return $this->enseignants;
    }

    /**
     * @param mixed $enseignants
     */
    public function setEnseignants($enseignants): void
    {
        $this->enseignants = $enseignants;
    }

    /**
     * @return mixed
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    /**
     * @param mixed $etudiants
     */
    public function setEtudiants($etudiants): void
    {
        $this->etudiants = $etudiants;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes): void
    {
        $this->classes = $classes;
    }

}
