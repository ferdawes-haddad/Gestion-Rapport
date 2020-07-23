<?php

namespace App\Entity;

use App\Repository\SoutenanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoutenanceRepository::class)
 */
class Soutenance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Enseignant")
     */
    private $encadrer;

    /**
     * @ORM\ManyToOne(targetEntity="Enseignant")
     */
    private $raporteur;

    /**
     * @ORM\ManyToOne(targetEntity="Enseignant")
     */
    private $president;

    /**
     * @ORM\ManyToOne(targetEntity="Etudiant")
     */
    private $etudiant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Enseignant
     */
    public function getEncadrer()
    {
        return $this->encadrer;
    }

    /**
     * @param mixed $encadrer
     */
    public function setEncadrer($encadrer): void
    {
        $this->encadrer = $encadrer;
    }

    /**
     * @return mixed
     */
    public function getRaporteur()
    {
        return $this->raporteur;
    }

    /**
     * @param mixed $raporteur
     */
    public function setRaporteur($raporteur): void
    {
        $this->raporteur = $raporteur;
    }

    /**
     * @return mixed
     */
    public function getPresident()
    {
        return $this->president;
    }

    /**
     * @param mixed $president
     */
    public function setPresident($president): void
    {
        $this->president = $president;
    }

    /**
     * @return mixed
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param mixed $etudiant
     */
    public function setEtudiant($etudiant): void
    {
        $this->etudiant = $etudiant;
    }



}
