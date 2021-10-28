<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StrategyRepository::class)
 */
class Strategy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $visibility;

    /**
     * @ORM\OneToMany(targetEntity=StrategyAction::class, mappedBy="strategy")
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="strategies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Dungeon::class, inversedBy="strategies")
     */
    private $dungeon;

    public function __construct()
    {
        $this->action = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(?string $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return Collection|StrategyAction[]
     */
    public function getAction(): Collection
    {
        return $this->action;
    }

    public function addAction(StrategyAction $action): self
    {
        if (!$this->action->contains($action)) {
            $this->action[] = $action;
            $action->setStrategy($this);
        }

        return $this;
    }

    public function removeAction(StrategyAction $action): self
    {
        if ($this->action->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getStrategy() === $this) {
                $action->setStrategy(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getDungeon(): ?Dungeon
    {
        return $this->dungeon;
    }

    public function setDungeon(?Dungeon $dungeon): self
    {
        $this->dungeon = $dungeon;

        return $this;
    }
}
