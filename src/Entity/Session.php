<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SessionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Mapping\Annotation as Gedmo;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 * @Vich\Uploadable
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    // /**
    //  * @Gedmo\Slug(fields={"name"})
    //  * @ORM\Column(type="string", length=255, unique=true)
    //  */
    // private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $file;

    /**
     *
     * @Vich\UploadableField(mapping="session_images", fileNameProperty="file")
     *
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="30", minMessage="La description doit comporter au minimum 30 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
    * @ORM\Column(type="json")
    */
    private $state = [];

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="session")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity=Challenge::class, mappedBy="session", orphanRemoval=true)
     */
    private $challenges;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="session")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $admin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->setCreatedAt(new \DateTime('Europe/Monaco'));
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartdate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEnddate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getState(): array
    {
        $state = $this->state;
        // guarantee every group at least was open
        $state[] = '';

        return array_unique($state);
    }

    public function setState(array $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->setSession($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getSession() === $this) {
                $group->setSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Challenge[]
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->setSession($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        if ($this->challenges->removeElement($challenge)) {
            // set the owning side to null (unless already changed)
            if ($challenge->getSession() === $this) {
                $challenge->setSession(null);
            }
        }

        return $this;
    }

    // public function getAdmin(): ?Admin
    // {
    //     return $this->admin;
    // }

    // public function setAdmin(?Admin $admin): self
    // {
    //     $this->admin = $admin;

    //     return $this;
    // }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }



    public function __toString()
    {
        return $this->name;
    }
}
