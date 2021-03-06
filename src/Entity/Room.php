<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoomRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"room:read"}},
 *      denormalizationContext={"groups"={"room:write"}}
 * )
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("room:read", "user: read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="float")
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $image2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $image3;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * 
     * @Groups("room:read")
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="room", orphanRemoval=true)
     * 
     * @Groups("room:read")
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $isKingSize;

    /**
     * @ORM\Column(type="smallint")
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $nbBed;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"room:read", "room:write"})
     */
    private $squarFeet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("room:read")
     */
    private $author;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->comments = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRoom($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRoom() === $this) {
                $comment->setRoom(null);
            }
        }

        return $this;
    }

    public function getIsKingSize(): ?bool
    {
        return $this->isKingSize;
    }

    public function setIsKingSize(?bool $isKingSize): self
    {
        $this->isKingSize = $isKingSize;

        return $this;
    }

    public function getNbBed(): ?int
    {
        return $this->nbBed;
    }

    public function setNbBed(?int $nbBed): self
    {
        $this->nbBed = $nbBed;

        return $this;
    }

    public function getSquarFeet(): ?int
    {
        return $this->squarFeet;
    }

    public function setSquarFeet(?int $squarFeet): self
    {
        $this->squarFeet = $squarFeet;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
