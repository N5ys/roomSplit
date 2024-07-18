<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateTask = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEffective = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeTask = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUpdate = null;

    #[ORM\ManyToOne(inversedBy: 'task')]
    private ?Category $category = null;

    /**
     * @var Collection<int, Document>
     */
    #[ORM\OneToMany(targetEntity: Document::class, mappedBy: 'task')]
    #[Ignore]
    private ?Collection $documents;

    #[ORM\ManyToOne(inversedBy: 'tasks')]

    private ?Roommate $responsable = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?House $house = null;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateTask(): ?\DateTimeInterface
    {
        return $this->dateTask;
    }

    public function setDateTask(?\DateTimeInterface $dateTask): static
    {
        $this->dateTask = $dateTask;

        return $this;
    }

    public function getDateEffective(): ?\DateTimeInterface
    {
        return $this->dateEffective;
    }

    public function setDateEffective(?\DateTimeInterface $dateEffective): static
    {
        $this->dateEffective = $dateEffective;

        return $this;
    }

    public function isDone(): ?bool
    {
        return $this->isDone;
    }

    public function setDone(?bool $isDone): static
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getTypeTask(): ?string
    {
        return $this->typeTask;
    }

    public function setTypeTask(?string $typeTask): static
    {
        $this->typeTask = $typeTask;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setTask($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getTask() === $this) {
                $document->setTask(null);
            }
        }

        return $this;
    }

    public function getResponsable(): ?roommate
    {
        return $this->responsable;
    }

    public function setResponsable(?roommate $responsable): static
    {
        $this->responsable = $responsable;

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
