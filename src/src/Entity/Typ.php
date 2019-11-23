<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypRepository")
 */
class Typ
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
    private $nazev;

    /**
     * @ORM\Column(type="integer")
     */
    private $pocet_clenu_tymu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tym", mappedBy="typ")
     */
    private $tymy;

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

    public function getPocetClenuTymu(): ?int
    {
        return $this->pocet_clenu_tymu;
    }

    public function setPocetClenuTymu(int $pocet_clenu_tymu): self
    {
        $this->pocet_clenu_tymu = $pocet_clenu_tymu;

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
            $tymy->setTyp($this);
        }

        return $this;
    }

    public function removeTymy(Tym $tymy): self
    {
        if ($this->tymy->contains($tymy)) {
            $this->tymy->removeElement($tymy);
            // set the owning side to null (unless already changed)
            if ($tymy->getTyp() === $this) {
                $tymy->setTyp(null);
            }
        }

        return $this;
    }
}
