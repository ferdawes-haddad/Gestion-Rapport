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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @ORM\Assert\NotBlank(message="Ajouter une image jpg")
     * @ORM\Assert\File(mimeTypes={ "image/jpeg" })
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
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

    /**
     * @return ArrayCollection
     */
    public function getEtudiants(): ArrayCollection
    {
        return $this->etudiants;
    }

    /**
     * @param ArrayCollection $etudiants
     */
    public function setEtudiants(ArrayCollection $etudiants): void
    {
        $this->etudiants = $etudiants;
    }

    /**
     * @return ArrayCollection
     */
    public function getEnseignants(): ArrayCollection
    {
        return $this->enseignants;
    }

    /**
     * @param ArrayCollection $enseignants
     */
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

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document): void
    {
        $this->document = $document;
    }



}
