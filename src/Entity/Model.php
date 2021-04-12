<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"model:read"}},
 * denormalizationContext={"groups"={"model:write"}}
 * )
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 */
class Model
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("model:read")
     * @Groups("advert:write")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("model:read")
     * @Groups("model:write")
     * @Groups("advert:read")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("model:read")
     * @Groups("model:write")
     * @Groups("advert:read")
     */
    private $brand;

    /**
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="model", orphanRemoval=true)
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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

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
            $advert->setModel($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->removeElement($advert)) {
            // set the owning side to null (unless already changed)
            if ($advert->getModel() === $this) {
                $advert->setModel(null);
            }
        }

        return $this;
    }
}