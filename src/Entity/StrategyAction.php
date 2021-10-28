<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StrategyActionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StrategyActionRepository::class)
 */
class StrategyAction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity=Strategy::class, inversedBy="action")
     */
    private $strategy;

    /**
     * @ORM\ManyToOne(targetEntity=Spell::class)
     */
    private $bossSpell;

    /**
     * @ORM\ManyToOne(targetEntity=Spell::class)
     */
    private $deffSpell;

    /**
     * @ORM\ManyToOne(targetEntity=Npc::class, inversedBy="strategyActions")
     */
    private $boss;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?int
    {
        return $this->action;
    }

    public function setAction(?int $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getStrategy(): ?Strategy
    {
        return $this->strategy;
    }

    public function setStrategy(?Strategy $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getBossSpell(): ?Spell
    {
        return $this->bossSpell;
    }

    public function setBossSpell(?Spell $bossSpell): self
    {
        $this->bossSpell = $bossSpell;

        return $this;
    }

    public function getDeffSpell(): ?Spell
    {
        return $this->deffSpell;
    }

    public function setDeffSpell(?Spell $deffSpell): self
    {
        $this->deffSpell = $deffSpell;

        return $this;
    }

    public function getBoss(): ?Npc
    {
        return $this->boss;
    }

    public function setBoss(?Npc $boss): self
    {
        $this->boss = $boss;

        return $this;
    }
}
