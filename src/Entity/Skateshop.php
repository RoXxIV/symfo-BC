<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SkateshopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"skateshop:read"}},
 * denormalizationContext={"groups"={"skateshop:write"}}
 * )
 * @ORM\Entity(repositoryClass=SkateshopRepository::class)
 */
class Skateshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("skateshop:read")
     * @Groups("advert:write")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     * @Groups("advert:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=70)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="skateshops")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("skateshop:read")
     * @Groups("skateshop:write")
     */
    private $professional;

    /**
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="skateshop", orphanRemoval=true)
     */
    private $adverts;

    public function __construct()
    {
        $this->adverts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getProfessional(): ?User
    {
        return $this->professional;
    }

    public function setProfessional(?User $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
            $advert->setSkateshop($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->removeElement($advert)) {
            // set the owning side to null (unless already changed)
            if ($advert->getSkateshop() === $this) {
                $advert->setSkateshop(null);
            }
        }

        return $this;
    }
}
