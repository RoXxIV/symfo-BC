<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(
 * normalizationContext={"groups"={"user:read"}},
 * denormalizationContext={"groups"={"user:write"}},
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     * @Groups("skateshop:write")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user:read")
     * @Groups("user:write")
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Groups("user:read")
     * @Groups("user:write")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("user:write")
     * @Groups("user:read")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups("user:read")
     * @Groups("user:write")
     * @Groups("skateshop:read")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("user:read")
     * @Groups("user:write")
     * @Groups("skateshop:read")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("user:read")
     * @Groups("user:write")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=14)
     * @Groups("user:read")
     * @Groups("user:write")
     */
    private $siretNumber;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("user:read")
     * @Groups("user:write")
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=Skateshop::class, mappedBy="professional", orphanRemoval=true)
     */
    private $skateshops;

    public function __construct()
    {
        $this->skateshops = new ArrayCollection();
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
        // $roles[] = 'ROLE_USER';

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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siretNumber;
    }

    public function setSiretNumber(string $siretNumber): self
    {
        $this->siretNumber = $siretNumber;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Skateshop[]
     */
    public function getSkateshops(): Collection
    {
        return $this->skateshops;
    }

    public function addSkateshop(Skateshop $skateshop): self
    {
        if (!$this->skateshops->contains($skateshop)) {
            $this->skateshops[] = $skateshop;
            $skateshop->setProfessional($this);
        }

        return $this;
    }

    public function removeSkateshop(Skateshop $skateshop): self
    {
        if ($this->skateshops->removeElement($skateshop)) {
            // set the owning side to null (unless already changed)
            if ($skateshop->getProfessional() === $this) {
                $skateshop->setProfessional(null);
            }
        }

        return $this;
    }
}
