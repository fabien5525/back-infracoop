<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource()]
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $Nom = null;

    #[ORM\Column(length: 255), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $Prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?\DateTimeInterface $DateDeNaissance = null;

    #[ORM\Column(length: 255), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $NumeroDePermis = null;

    #[ORM\OneToMany(mappedBy: 'Client', targetEntity: Location::class), Groups(['get:utilisateur'])]
    private Collection $locations;

    #[ORM\OneToOne(mappedBy: 'Client', cascade: ['persist', 'remove'])]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getNumeroDePermis(): ?string
    {
        return $this->NumeroDePermis;
    }

    public function setNumeroDePermis(string $NumeroDePermis): self
    {
        $this->NumeroDePermis = $NumeroDePermis;

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
            $location->setClient($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getClient() === $this) {
                $location->setClient(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        // set the owning side of the relation if necessary
        if ($utilisateur->getClient() !== $this) {
            $utilisateur->setClient($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }
}
