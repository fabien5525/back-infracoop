<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    #open post method for registration
    collectionOperations: ['get' => [
        'security' => 'is_granted("ROLE_ADMIN")',
        'security_message' => 'Only admins can access this route',
        'normalization_context' => ['groups' => ['get:utilisateur']],
    ], 'post' => [
        'normalization_context' => ['groups' => ['post:utilisateur']],
        'denormalization_context' => ['groups' => ['post:utilisateur']]
    ]],
    itemOperations: ['get' => [
        'security' => 'is_granted("ROLE_ADMIN") or object == user',
        'security_message' => 'Only admins can access this route or user himself',
        'normalization_context' => ['groups' => ['get:utilisateur']]
    ], 'put' => [
        'security' => 'is_granted("ROLE_ADMIN") or object == user',
        'security_message' => 'Only admins can access this route or user himself',
    ], 'delete' => [
        'security' => 'is_granted("ROLE_ADMIN") or object == user',
        'security_message' => 'Only admins can access this route or user himself',
        'normalization_context' => ['groups' => ['get:utilisateur']]
    ]],
)]
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?string $email = null;

    #[ORM\Column, Groups(['get:utilisateur'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column, Groups(['post:utilisateur'])]
    private ?string $password = null;

    #[ORM\OneToOne(inversedBy: 'utilisateur', cascade: ['persist', 'remove']), ORM\JoinColumn(nullable: false), Groups(['get:utilisateur', 'post:utilisateur'])]
    private ?Client $Client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        //hash password
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
