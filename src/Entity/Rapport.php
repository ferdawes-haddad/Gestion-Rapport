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
     * @ORM\Column(type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee;

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

    public function getEnseignants()
    {
        return $this->enseignants;
    }
    public function setEnseignants($enseignants)
    {
        $this->enseignants = $enseignants;
    }

    public function getClasse()
    {
        return $this->classe;
    }
    public function setClasse($classe): void
    {
        $this->classe = $classe;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }
    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee): void
    {
        $this->annee = $annee;
    }




//    public function getEtudiants(): ?string
//    {
//        return $this->etudiants;
//    }
//    public function setEtudiants($etudiants): void
//    {
//        $this->etudiants = $etudiants;
//    }

    public function __construct() {
        $this->enseignants = new ArrayCollection();
    }



}
