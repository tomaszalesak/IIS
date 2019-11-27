<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UzivatelRepository")
 * @UniqueEntity(fields={"username"}, message="Uživatel s takovým jménem už existuje")
 */
class Uzivatel implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jmeno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prijmeni;

    /**
     * @ORM\Column(type="date")
     */
    private $datum_narozeni;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tym", mappedBy="uzivatele")
     */
    private $tymy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tym", mappedBy="vedouci")
     */
    private $vedouci_tymu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Turnaj", mappedBy="vedouci")
     */
    private $vedouci_turnaje;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $je_rozhodci;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Turnaj", mappedBy="rozhodci")
     */
    private $piskam_utkani;

    public function __construct()
    {
        $this->tymy = new ArrayCollection();
        $this->vedouci_tymu = new ArrayCollection();
        $this->piskam_utkani = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): self
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getDatumNarozeni(): ?\DateTimeInterface
    {
        return $this->datum_narozeni;
    }

    public function setDatumNarozeni(\DateTimeInterface $datum_narozeni): self
    {
        $this->datum_narozeni = $datum_narozeni;

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
            $tymy->addUzivatele($this);
        }

        return $this;
    }

    public function removeTymy(Tym $tymy): self
    {
        if ($this->tymy->contains($tymy)) {
            $this->tymy->removeElement($tymy);
            $tymy->removeUzivatele($this);
        }

        return $this;
    }

    /**
     * @return Collection|Tym[]
     */
    public function getVedouciTymu(): Collection
    {
        return $this->vedouci_tymu;
    }

    public function addVedouciTymu(Tym $vedouciTymu): self
    {
        if (!$this->vedouci_tymu->contains($vedouciTymu)) {
            $this->vedouci_tymu[] = $vedouciTymu;
            $vedouciTymu->setVedouci($this);
        }

        return $this;
    }

    public function removeVedouciTymu(Tym $vedouciTymu): self
    {
        if ($this->vedouci_tymu->contains($vedouciTymu)) {
            $this->vedouci_tymu->removeElement($vedouciTymu);
            // set the owning side to null (unless already changed)
            if ($vedouciTymu->getVedouci() === $this) {
                $vedouciTymu->setVedouci(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Turnaj[]
     */
    public function getVedouciTurnaje(): Collection
    {
        return $this->vedouci_turnaje;
    }

    public function addVedouciTurnaje(Turnaj $vedouciTurnaje): self
    {
        if (!$this->vedouci_turnaje->contains($vedouciTurnaje)) {
            $this->vedouci_turnaje[] = $vedouciTurnaje;
            $vedouciTurnaje->setVedouci($this);
        }

        return $this;
    }

    public function removeVedouciTurnaje(Turnaj $vedouciTurnaje): self
    {
        if ($this->vedouci_turnaje->contains($vedouciTurnaje)) {
            $this->vedouci_turnaje->removeElement($vedouciTurnaje);
            // set the owning side to null (unless already changed)
            if ($vedouciTurnaje->getVedouci() === $this) {
                $vedouciTurnaje->setVedouci(null);
            }
        }

        return $this;
    }

    public function getJeRozhodci(): ?int
    {
        return $this->je_rozhodci;
    }

    public function setJeRozhodci(?int $je_rozhodci): self
    {
        $this->je_rozhodci = $je_rozhodci;

        return $this;
    }

    /**
     * @return Collection|Turnaj[]
     */
    public function getPiskamUtkani(): Collection
    {
        return $this->piskam_utkani;
    }

    public function addPiskamUtkani(Turnaj $piskamUtkani): self
    {
        if (!$this->piskam_utkani->contains($piskamUtkani)) {
            $this->piskam_utkani[] = $piskamUtkani;
            $piskamUtkani->addRozhodci($this);
        }

        return $this;
    }

    public function removePiskamUtkani(Turnaj $piskamUtkani): self
    {
        if ($this->piskam_utkani->contains($piskamUtkani)) {
            $this->piskam_utkani->removeElement($piskamUtkani);
            $piskamUtkani->removeRozhodci($this);
        }

        return $this;
    }



}
