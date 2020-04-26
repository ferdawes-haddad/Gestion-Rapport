<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="Section")
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

}
