<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SpellRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SpellRepository::class)
 */
class Spell
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $href;

    /**
     * @ORM\ManyToOne(targetEntity=Npc::class, inversedBy="spell")
     */
    private $npc;

    /**
     * @ORM\ManyToOne(targetEntity=ClassSpec::class, inversedBy="spell")
     */
    private $classSpec;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blizzardId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getNpc(): ?Npc
    {
        return $this->npc;
    }

    public function setNpc(?Npc $npc): self
    {
        $this->npc = $npc;

        return $this;
    }

    public function getClassSpec(): ?ClassSpec
    {
        return $this->classSpec;
    }

    public function setClassSpec(?ClassSpec $classSpec): self
    {
        $this->classSpec = $classSpec;

        return $this;
    }

    public function getBlizzardId(): ?string
    {
        return $this->blizzardId;
    }

    public function setBlizzardId(?string $blizzardId): self
    {
        $this->blizzardId = $blizzardId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
