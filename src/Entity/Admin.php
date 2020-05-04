<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin
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
    private $document;

    /** @ORM\Column(type="datetime") */
    private $dateDepos;

    /**
     * @ORM\OneToMany(targetEntity="Etudiant", mappedBy="admin")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity="Enseignant", mappedBy="admin")
     */
    private $enseignants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepos()
    {
        return $this->dateDepos;
    }

    public function setDateDepos($dateDepos): void
    {
        $this->dateDepos = $dateDepos;

        // WILL be saved in the database
        //$this->updated = new \DateTime("now");
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($document): void
    {
        $this->document = $document;
    }

    public function getEtudiants(): ArrayCollection
    {
        return $this->etudiants;
    }

    public function setEtudiants(ArrayCollection $etudiants): void
    {
        $this->etudiants = $etudiants;
    }

    public function getEnseignants(): ArrayCollection
    {
        return $this->enseignants;
    }

    public function setEnseignants(ArrayCollection $enseignants): void
    {
        $this->enseignants = $enseignants;
    }

    public function __constructEtudiannt() {
        $this->etudiants = new ArrayCollection();
    }

    public function __constructEnseignant() {
        $this->enseignants = new ArrayCollection();
    }

}
