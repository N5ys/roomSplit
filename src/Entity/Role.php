<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUpdate = null;

    /**
     * @var Collection<int, roommate>
     */
    #[ORM\ManyToMany(targetEntity: roommate::class, inversedBy: 'roles')]
    #[Ignore]
    private Collection $roommates;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    private ?House $house = null;

    public function __construct()
    {
        $this->roommates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(?\DateTimeInterface $dateUpdate): static
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * @return Collection<int, roommate>
     */
    public function getRoommates(): Collection
    {
        return $this->roommates;
    }

    public function addRoommate(roommate $roommate): static
    {
        if (!$this->roommates->contains($roommate)) {
            $this->roommates->add($roommate);
        }

        return $this;
    }

    public function removeRoommate(roommate $roommate): static
    {
        $this->roommates->removeElement($roommate);

        return $this;
    }

    public function getHouse(): ?house
    {
        return $this->house;
    }

    public function setHouse(?house $house): static
    {
        $this->house = $house;

        return $this;
    }
}
