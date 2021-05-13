<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupRepository;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 * @UniqueEntity(fields={"name"}, message="Ce nom est déjà utilisé !")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min="10", minMessage="Le nom doit comporter au minimum 10 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $owner;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
    * @ORM\Column(type="json")
    */
    private $state = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $score = 0;

    /**
     *
     * @ORM\ManyToMany(targetEntity=Challenge::class, inversedBy="group")
     */
    private $challenge;

    /**
    * @ORM\OneToMany(targetEntity=User::class, mappedBy="groups", orphanRemoval=true)
    * @ORM\JoinColumn(nullable=false)
    */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank( message ="Vous devez choisir une session");
     */
    private $session;

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
        $this->challenge = new ArrayCollection();
        $this->setCreatedAt(new \DateTime('Europe/Monaco'));
        $this->setState(array('Ouvert'));
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

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

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
    

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection|Challenge[]
     */
    public function getChallenge(): Collection
    {
        return $this->challenge;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenge->contains($challenge)) {
            $this->challenge[] = $challenge;
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        $this->challenge->removeElement($challenge);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGroups($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }


    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

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
