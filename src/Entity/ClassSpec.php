<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClassSpecRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ClassSpecRepository::class)
 * @Vich\Uploadable()
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
     * @Vich\UploadableField(mapping="class", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\OneToMany(targetEntity=Spell::class, mappedBy="classSpec")
     */
    private $spell;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blizzardId;

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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return ClassSpec
     */
    public function setUpdatedAt(\DateTime $updatedAt): ClassSpec
    {
        $this->updatedAt = $updatedAt;
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
}
