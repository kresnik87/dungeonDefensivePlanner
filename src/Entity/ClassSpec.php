<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClassSpecRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ClassSpecRepository::class)
 */
class ClassSpec
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
     * @ORM\OneToMany(targetEntity=Spell::class, mappedBy="classSpec")
     */
    private $spell;

    public function __construct()
    {
        $this->spell = new ArrayCollection();
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
            $spell->setClassSpec($this);
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        if ($this->spell->removeElement($spell)) {
            // set the owning side to null (unless already changed)
            if ($spell->getClassSpec() === $this) {
                $spell->setClassSpec(null);
            }
        }

        return $this;
    }
}
