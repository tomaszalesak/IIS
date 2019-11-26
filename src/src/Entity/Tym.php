<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TymRepository")
 * @UniqueEntity(fields={"jmeno"}, message="Tým se stejným názvem už existuje")
 */
class Tym
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
    private $jmeno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typ", inversedBy="tymy")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Vyplňte prosím toto pole")
     */
    private $typ;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Uzivatel", inversedBy="tymy")
     */
    private $uzivatele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzivatel", inversedBy="vedouci_tymu")
     */
    private $vedouci;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $popis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresa;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Turnaj", mappedBy="tymy")
     */
    private $turnaje;

    public function __construct()
    {
        $this->uzivatele = new ArrayCollection();
        $this->turnaje = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getTyp(): ?Typ
    {
        return $this->typ;
    }

    public function setTyp(?Typ $Typ): self
    {
        $this->typ = $Typ;

        return $this;
    }

    /**
     * @return Collection|Uzivatel[]
     */
    public function getUzivatele(): Collection
    {
        return $this->uzivatele;
    }

    public function addUzivatele(Uzivatel $uzivatele): self
    {
        if (!$this->uzivatele->contains($uzivatele)) {
            $this->uzivatele[] = $uzivatele;
        }

        return $this;
    }

    public function removeUzivatele(Uzivatel $uzivatele): self
    {
        if ($this->uzivatele->contains($uzivatele)) {
            $this->uzivatele->removeElement($uzivatele);
        }

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

    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    public function setAdresa(?string $adresa): self
    {
        $this->adresa = $adresa;

        return $this;
    }

    /**
     * @return Collection|Turnaj[]
     */
    public function getTurnaje(): Collection
    {
        return $this->turnaje;
    }

    public function addTurnaje(Turnaj $turnaje): self
    {
        if (!$this->turnaje->contains($turnaje)) {
            $this->turnaje[] = $turnaje;
            $turnaje->addTymy($this);
        }

        return $this;
    }

    public function removeTurnaje(Turnaj $turnaje): self
    {
        if ($this->turnaje->contains($turnaje)) {
            $this->turnaje->removeElement($turnaje);
            $turnaje->removeTymy($this);
        }

        return $this;
    }
}
