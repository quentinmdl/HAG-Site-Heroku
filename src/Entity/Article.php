<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage="Le titre doit comporter 10 caractères minimum")
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url( 
     *      message = "Une url d'une image est attendu",
     * )
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=20, max=255, minMessage="La description doit comporter 10 caractères minimum")
     */
    private $description;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="article")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
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
}
