<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $typeCategory = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUpdate = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'category')]
    #[Ignore]
    private ?Collection $task;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'category')]
    #[Ignore]
    private ?Collection $event;

    /**
     * @var Collection<int, Expense>
     */
    #[ORM\OneToMany(targetEntity: Expense::class, mappedBy: 'category')]
    #[Ignore]
    private ?Collection $expense;

    /**
     * @var Collection<int, Document>
     */
    #[ORM\OneToMany(targetEntity: Document::class, mappedBy: 'category')]
    #[Ignore]
    private ?Collection $document;

    public function __construct()
    {
        $this->task = new ArrayCollection();
        $this->event = new ArrayCollection();
        $this->expense = new ArrayCollection();
        $this->document = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    public function getTypeCategory(): ?string
    {
        return $this->typeCategory;
    }

    public function setTypeCategory(string $typeCategory): static
    {
        $this->typeCategory = $typeCategory;

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
     * @return Collection<int, task>
     */
    public function getTask(): Collection
    {
        return $this->task;
    }

    public function addTask(task $task): static
    {
        if (!$this->task->contains($task)) {
            $this->task->add($task);
            $task->setCategory($this);
        }

        return $this;
    }

    public function removeTask(task $task): static
    {
        if ($this->task->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCategory() === $this) {
                $task->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, event>
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(event $event): static
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
            $event->setCategory($this);
        }

        return $this;
    }

    public function removeEvent(event $event): static
    {
        if ($this->event->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, expense>
     */
    public function getExpense(): Collection
    {
        return $this->expense;
    }

    public function addExpense(expense $expense): static
    {
        if (!$this->expense->contains($expense)) {
            $this->expense->add($expense);
            $expense->setCategory($this);
        }

        return $this;
    }

    public function removeExpense(expense $expense): static
    {
        if ($this->expense->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getCategory() === $this) {
                $expense->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, document>
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(document $document): static
    {
        if (!$this->document->contains($document)) {
            $this->document->add($document);
            $document->setCategory($this);
        }

        return $this;
    }

    public function removeDocument(document $document): static
    {
        if ($this->document->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getCategory() === $this) {
                $document->setCategory(null);
            }
        }

        return $this;
    }
}
