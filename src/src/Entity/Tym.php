<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TymRepository")
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
     */
    private $jmeno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typ", inversedBy="tymy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typ;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Uzivatel", inversedBy="tymy")
     */
    private $uzivatele;

    public function __construct()
    {
        $this->uzivatele = new ArrayCollection();
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
}
