<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::BINARY)]
    private $file;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUpdate = null;

    #[ORM\ManyToOne(inversedBy: 'document')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?Task $task = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?Expense $expense = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?House $house = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): static
    {
        $this->file = $file;

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

    public function getEvent(): ?event
    {
        return $this->event;
    }

    public function setEvent(?event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getTask(): ?task
    {
        return $this->task;
    }

    public function setTask(?task $task): static
    {
        $this->task = $task;

        return $this;
    }

    public function getExpense(): ?expense
    {
        return $this->expense;
    }

    public function setExpense(?expense $expense): static
    {
        $this->expense = $expense;

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
