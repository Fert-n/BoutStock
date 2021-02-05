<?php

namespace App\Entity;

use App\Repository\BottleRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BottleRepository::class)
 */
class Bottle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @Assert\PositiveOrZero()
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="date")
     */
    private $misebout;

    /**
     * @ORM\Column(type="date")
     */
    private $createat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="integer")
     */
    private $contenance;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="bottles")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Cave::class, inversedBy="bottles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cave;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMisebout(): ?\DateTimeInterface
    {
        return $this->misebout;
    }

    public function setMisebout(\DateTimeInterface $misebout): self
    {
        $this->misebout = $misebout;

        return $this;
    }

    public function getCreateat(): ?\DateTimeInterface
    {
        return $this->createat;
    }

    public function setCreateAt(\DateTimeInterface $createat): self
    {
        $this->createat = $createat;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getContenance(): ?int
    {
        return $this->contenance;
    }

    public function setContenance(int $contenance): self
    {
        $this->contenance = $contenance;

        return $this;
    }

    public function getType(): ?Category
    {
        return $this->type;
    }

    public function setType(?Category $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Bottle
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCave(): ?Cave
    {
        return $this->cave;
    }

    public function setCave(?Cave $cave): self
    {
        $this->cave = $cave;

        return $this;
    }
}
