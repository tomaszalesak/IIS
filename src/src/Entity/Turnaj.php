<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TurnajRepository")
 * @UniqueEntity(fields={"nazev"}, message="Turnaj se stejným názvem už existuje")
 */
class Turnaj
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vyplňte prosím toto pole")
     */
    private $nazev;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresa;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Vyplňte prosím toto pole")
     */
    private $datum;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vyplňte prosím toto pole")
     */
    private $minimum_tymu;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vyplňte prosím toto pole")
     * @Assert\GreaterThan(propertyPath="minimum_tymu",message="Toto pole musí být větší než Minimální počet týmů")
     */
    private $maximum_tymu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tym", inversedBy="turnaje")
     */
    private $tymy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typ", inversedBy="turnaje")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typ;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzivatel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vedouci;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $popis;

    public function __construct()
    {
        $this->tymy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;

        return $this;
    }

    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    public function setAdresa(?string $adresa): self
    {
        $this->adresa = $adresa;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getMinimumTymu(): ?int
    {
        return $this->minimum_tymu;
    }

    public function setMinimumTymu(int $minimum_tymu): self
    {
        $this->minimum_tymu = $minimum_tymu;

        return $this;
    }

    public function getMaximumTymu(): ?int
    {
        return $this->maximum_tymu;
    }

    public function setMaximumTymu(int $maximum_tymu): self
    {
        $this->maximum_tymu = $maximum_tymu;

        return $this;
    }

    /**
     * @return Collection|Tym[]
     */
    public function getTymy(): Collection
    {
        return $this->tymy;
    }

    public function addTymy(Tym $tymy): self
    {
        if (!$this->tymy->contains($tymy)) {
            $this->tymy[] = $tymy;
        }

        return $this;
    }

    public function removeTymy(Tym $tymy): self
    {
        if ($this->tymy->contains($tymy)) {
            $this->tymy->removeElement($tymy);
        }

        return $this;
    }

    public function getTyp(): ?Typ
    {
        return $this->typ;
    }

    public function setTyp(?Typ $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getVedouci(): ?Uzivatel
    {
        return $this->vedouci;
    }

    public function setVedouci(?Uzivatel $vedouci): self
    {
        $this->vedouci = $vedouci;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->popis;
    }

    public function setPopis(?string $popis): self
    {
        $this->popis = $popis;

        return $this;
    }
}
