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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turnaj", inversedBy="utkani")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turnaj;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kolo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tym", inversedBy="vyherni_utkani")
     */
    private $vyherce;

    /**
     * @ORM\Column(type="integer")
     */
    private $cislo_utkani;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $domaci_body;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hoste_body;

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

    public function getTurnaj(): ?Turnaj
    {
        return $this->turnaj;
    }

    public function setTurnaj(?Turnaj $turnaj): self
    {
        $this->turnaj = $turnaj;

        return $this;
    }

    public function getKolo(): ?int
    {
        return $this->kolo;
    }

    public function setKolo(?int $kolo): self
    {
        $this->kolo = $kolo;

        return $this;
    }

    public function getVyherce(): ?Tym
    {
        return $this->vyherce;
    }

    public function setVyherce(?Tym $vyherce): self
    {
        $this->vyherce = $vyherce;

        return $this;
    }

    public function getCisloUtkani(): ?int
    {
        return $this->cislo_utkani;
    }

    public function setCisloUtkani(int $cislo_utkani): self
    {
        $this->cislo_utkani = $cislo_utkani;

        return $this;
    }

    public function getDomaciBody(): ?int
    {
        return $this->domaci_body;
    }

    public function setDomaciBody(?int $domaci_body): self
    {
        $this->domaci_body = $domaci_body;

        return $this;
    }

    public function getHosteBody(): ?int
    {
        return $this->hoste_body;
    }

    public function setHosteBody(?int $hoste_body): self
    {
        $this->hoste_body = $hoste_body;

        return $this;
    }
}
