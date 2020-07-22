<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
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

//    /**
//     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="etudiants")
//     */
//    private $admin;

    /**
     * @ORM\OneToMany(targetEntity="Rapport", mappedBy="etudiants")
     */
    private $rapports;

    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    public function __construct() {
        $this->rapports = new ArrayCollection();
    }
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return ArrayCollection
     */
    public function getRapports(): ArrayCollection
    {
        return $this->rapports;
    }

    /**
     * @param ArrayCollection $rapports
     */
    public function setRapports(ArrayCollection $rapports): void
    {
        $this->rapports = $rapports;
    }

}
