<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtkaniRepository")
 */
class Utkani
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tym", inversedBy="utkani_hoste")
     */
    private $hoste;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tym", inversedBy="utkani_domaci")
     */
    private $domaci;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoste(): ?Tym
    {
        return $this->hoste;
    }

    public function setHoste(?Tym $hoste): self
    {
        $this->hoste = $hoste;

        return $this;
    }

    public function getDomaci(): ?Tym
    {
        return $this->domaci;
    }

    public function setDomaci(?Tym $domaci): self
    {
        $this->domaci = $domaci;

        return $this;
    }
}
