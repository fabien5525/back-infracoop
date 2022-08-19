<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource()]
#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    #[ORM\Column(length: 255)]
    private ?string $Marque = null;

    #[ORM\Column(length: 255)]
    private ?string $Modele = null;

    #[ORM\Column(length: 255)]
    private ?string $NumeroDeSerie = null;

    #[ORM\Column(length: 255)]
    private ?string $Couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $PlaqueDImmatriculation = null;

    #[ORM\Column]
    private ?float $Kilometre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDAchat = null;

    #[ORM\Column]
    private ?float $PrixDAchat = null;

    #[ORM\Column]
    private ?bool $Disponible = null;

    #[ORM\Column]
    private ?bool $EnCoursDeLocation = null;

    #[ORM\OneToMany(mappedBy: 'Vehicule', targetEntity: Location::class)]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getNumeroDeSerie(): ?string
    {
        return $this->NumeroDeSerie;
    }

    public function setNumeroDeSerie(string $NumeroDeSerie): self
    {
        $this->NumeroDeSerie = $NumeroDeSerie;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getPlaqueDImmatriculation(): ?string
    {
        return $this->PlaqueDImmatriculation;
    }

    public function setPlaqueDImmatriculation(string $PlaqueDImmatriculation): self
    {
        $this->PlaqueDImmatriculation = $PlaqueDImmatriculation;

        return $this;
    }

    public function getKilometre(): ?float
    {
        return $this->Kilometre;
    }

    public function setKilometre(float $Kilometre): self
    {
        $this->Kilometre = $Kilometre;

        return $this;
    }

    public function getDateDAchat(): ?\DateTimeInterface
    {
        return $this->DateDAchat;
    }

    public function setDateDAchat(\DateTimeInterface $DateDAchat): self
    {
        $this->DateDAchat = $DateDAchat;

        return $this;
    }

    public function getPrixDAchat(): ?float
    {
        return $this->PrixDAchat;
    }

    public function setPrixDAchat(float $PrixDAchat): self
    {
        $this->PrixDAchat = $PrixDAchat;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->Disponible;
    }

    public function setDisponible(bool $Disponible): self
    {
        $this->Disponible = $Disponible;

        return $this;
    }

    public function isEnCoursDeLocation(): ?bool
    {
        return $this->EnCoursDeLocation;
    }

    public function setEnCoursDeLocation(bool $EnCoursDeLocation): self
    {
        $this->EnCoursDeLocation = $EnCoursDeLocation;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setVehicule($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVehicule() === $this) {
                $location->setVehicule(null);
            }
        }

        return $this;
    }
}
