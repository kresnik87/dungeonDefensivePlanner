<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NpcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NpcRepository::class)
 */
class Npc
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
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blizzardID;

    /**
     * @ORM\ManyToOne(targetEntity=Dungeon::class, inversedBy="npcs")
     */
    private $dungeon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $href;

    /**
     * @ORM\OneToMany(targetEntity=Spell::class, mappedBy="npc")
     */
    private $spell;

    /**
     * @ORM\OneToMany(targetEntity=StrategyAction::class, mappedBy="boss")
     */
    private $strategyActions;

    public function __construct()
    {
        $this->spell = new ArrayCollection();
        $this->strategyActions = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBlizzardID(): ?string
    {
        return $this->blizzardID;
    }

    public function setBlizzardID(?string $blizzardID): self
    {
        $this->blizzardID = $blizzardID;

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

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHref(?string $href): self
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return Collection|Spell[]
     */
    public function getSpell(): Collection
    {
        return $this->spell;
    }

    public function addSpell(Spell $spell): self
    {
        if (!$this->spell->contains($spell)) {
            $this->spell[] = $spell;
            $spell->setNpc($this);
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        if ($this->spell->removeElement($spell)) {
            // set the owning side to null (unless already changed)
            if ($spell->getNpc() === $this) {
                $spell->setNpc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StrategyAction[]
     */
    public function getStrategyActions(): Collection
    {
        return $this->strategyActions;
    }

    public function addStrategyAction(StrategyAction $strategyAction): self
    {
        if (!$this->strategyActions->contains($strategyAction)) {
            $this->strategyActions[] = $strategyAction;
            $strategyAction->setBoss($this);
        }

        return $this;
    }

    public function removeStrategyAction(StrategyAction $strategyAction): self
    {
        if ($this->strategyActions->removeElement($strategyAction)) {
            // set the owning side to null (unless already changed)
            if ($strategyAction->getBoss() === $this) {
                $strategyAction->setBoss(null);
            }
        }

        return $this;
    }
}
