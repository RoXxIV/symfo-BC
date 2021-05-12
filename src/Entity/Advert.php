<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdvertRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * attributes={"order"={"released_at":"DESC"}},
 * normalizationContext={"groups"={"advert:read"}},
 * denormalizationContext={"groups"={"advert:write"}},
 * 
 * )
 * @ORM\Entity(repositoryClass=AdvertRepository::class)
 */
class Advert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("advert:read")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $released_at;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $width;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $shape;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $concave;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $picturePath;

    /**
     * @ORM\Column(type="integer")
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="adverts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Skateshop::class, inversedBy="adverts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("advert:read")
     * @Groups("advert:write")
     */
    private $skateshop;

    public function __construct()
    {
        $this->released_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReleasedAt(): ?\DateTimeInterface
    {
        return $this->released_at;
    }

    public function setReleasedAt(\DateTimeInterface $released_at): self
    {
        $this->released_at = $released_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getShape(): ?string
    {
        return $this->shape;
    }

    public function setShape(string $shape): self
    {
        $this->shape = $shape;

        return $this;
    }

    public function getConcave(): ?string
    {
        return $this->concave;
    }

    public function setConcave(string $concave): self
    {
        $this->concave = $concave;

        return $this;
    }

    public function getPicturePath(): ?string
    {
        return $this->picturePath;
    }

    public function setPicturePath(string $picturePath): self
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSkateshop(): ?Skateshop
    {
        return $this->skateshop;
    }

    public function setSkateshop(?Skateshop $skateshop): self
    {
        $this->skateshop = $skateshop;

        return $this;
    }
}
