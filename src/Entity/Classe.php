<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="Rapport", mappedBy="classes")
     */
    private $rapports;

    /**
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="classes")
     */
    private $sections;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?int
    {
        return $this->classe;
    }

    public function setClasse(int $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections): void
    {
        $this->sections = $sections;
    }

    public function __toString()
    {
        return $this->getSections();
    }

    public function __construct() {
        $this->rapports = new ArrayCollection();
    }

}
