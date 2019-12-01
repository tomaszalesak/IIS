<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatistikyHraceRepository")
 */
class StatistikyHrace
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer",message="Hodnota {{ value }} není typu {{ type }}.")
     * @Assert\GreaterThan(-1, message="Hodnota nesmí být záporná")
     */
    private $dva_body;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer",message="Hodnota {{ value }} není typu {{ type }}.")
     * @Assert\GreaterThan(-1, message="Hodnota nesmí být záporná")
     *
     */
    private $tri_body;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer",message="Hodnota {{ value }} není typu {{ type }}.")
     * @Assert\GreaterThan(-1, message="Hodnota nesmí být záporná")
     */
    private $fauly;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Expression("value >= (this.getTriBody() *3)  + (this.getDvaBody() *2)",message="Tato hodnota neodpovídá bodům za dva a za tři")
     *  @Assert\Type(type="integer",message="Hodnota {{ value }} není typu {{ type }}.")
     * @Assert\GreaterThan(-1, message="Hodnota nesmí být záporná")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utkani", inversedBy="statistikyHracu")
     */
    private $utkani;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzivatel", inversedBy="statistiky")
     */
    private $hrac;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDvaBody(): ?int
    {
        return $this->dva_body;
    }

    public function setDvaBody(?int $dva_body): self
    {
        $this->dva_body = $dva_body;

        return $this;
    }

    public function getTriBody(): ?int
    {
        return $this->tri_body;
    }

    public function setTriBody(?int $tri_body): self
    {
        $this->tri_body = $tri_body;

        return $this;
    }

    public function getFauly(): ?int
    {
        return $this->fauly;
    }

    public function setFauly(?int $fauly): self
    {
        $this->fauly = $fauly;

        return $this;
    }

    public function getBody(): ?int
    {
        return $this->body;
    }

    public function setBody(?int $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getUtkani(): ?Utkani
    {
        return $this->utkani;
    }

    public function setUtkani(?Utkani $utkani): self
    {
        $this->utkani = $utkani;

        return $this;
    }

    public function getHrac(): ?Uzivatel
    {
        return $this->hrac;
    }

    public function setHrac(?Uzivatel $hrac): self
    {
        $this->hrac = $hrac;

        return $this;
    }
}
