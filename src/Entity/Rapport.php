<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="Enseignant", inversedBy="rapports")
     */
    private $enseignants;

//    /**
//     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy="rapports")
//     */
//    private $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity="Classe", inversedBy="rapports")
     */
    private $classes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
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

    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }
    public function setEnseignants($enseignants): void
    {
        $this->enseignants = $enseignants;
    }

    public function getClasses()
    {
        return $this->classes;
    }
    public function setClasses($classes): void
    {
        $this->classes = $classes;
    }

//    public function getEtudiants(): ?string
//    {
//        return $this->etudiants;
//    }
//    public function setEtudiants($etudiants): void
//    {
//        $this->etudiants = $etudiants;
//    }




}
