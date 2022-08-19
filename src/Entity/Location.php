<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    private ?Vehicule $Vehicule = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    private ?Client $Client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDeFin = null;

    #[ORM\Column]
    private ?float $Jour = null;

    #[ORM\Column]
    private ?float $PrixTotal = null;

    #[ORM\Column]
    private ?bool $Rendu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->Vehicule;
    }

    public function setVehicule(?Vehicule $Vehicule): self
    {
        $this->Vehicule = $Vehicule;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getDateDeFin(): ?\DateTimeInterface
    {
        return $this->DateDeFin;
    }

    public function setDateDeFin(\DateTimeInterface $DateDeFin): self
    {
        $this->DateDeFin = $DateDeFin;

        return $this;
    }

    public function getJour(): ?float
    {
        return $this->Jour;
    }

    public function setJour(float $Jour): self
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->PrixTotal;
    }

    public function setPrixTotal(float $PrixTotal): self
    {
        $this->PrixTotal = $PrixTotal;

        return $this;
    }

    public function isRendu(): ?bool
    {
        return $this->Rendu;
    }

    public function setRendu(bool $Rendu): self
    {
        $this->Rendu = $Rendu;

        return $this;
    }
}
