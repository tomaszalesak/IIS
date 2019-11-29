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
    private $pocet_tymu;


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
     * @ORM\Column(type="text", length=1024, nullable=true)
     */
    private $popis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Uzivatel", inversedBy="piskam_utkani")
     */
    private $rozhodci;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Utkani", mappedBy="turnaj")
     */
    private $utkani;



    public function __construct()
    {
        $this->tymy = new ArrayCollection();
        $this->rozhodci = new ArrayCollection();
        $this->utkani = new ArrayCollection();
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

    public function getPocetTymu(): ?int
    {
        return $this->pocet_tymu;
    }

    public function setpocetTymu(int $pocet_tymu): self
    {
        $this->pocet_tymu = $pocet_tymu;

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

    /**
     * @return Collection|Uzivatel[]
     */
    public function getRozhodci(): Collection
    {
        return $this->rozhodci;
    }

    public function addRozhodci(Uzivatel $rozhodci): self
    {
        if (!$this->rozhodci->contains($rozhodci)) {
            $this->rozhodci[] = $rozhodci;
        }

        return $this;
    }

    public function removeRozhodci(Uzivatel $rozhodci): self
    {
        if ($this->rozhodci->contains($rozhodci)) {
            $this->rozhodci->removeElement($rozhodci);
        }

        return $this;
    }

    /**
     * @return Collection|Utkani[]
     */
    public function getUtkani(): Collection
    {
        return $this->utkani;
    }

    public function addUtkani(Utkani $utkani): self
    {
        if (!$this->utkani->contains($utkani)) {
            $this->utkani[] = $utkani;
            $utkani->setTurnaj($this);
        }

        return $this;
    }

    public function removeUtkani(Utkani $utkani): self
    {
        if ($this->utkani->contains($utkani)) {
            $this->utkani->removeElement($utkani);
            // set the owning side to null (unless already changed)
            if ($utkani->getTurnaj() === $this) {
                $utkani->setTurnaj(null);
            }
        }

        return $this;
    }



}
