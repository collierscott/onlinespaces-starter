<?php

namespace App\Entity;

use App\Model\AuthoredEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
 */
class Article extends Content implements AuthoredEntityInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $introContent;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedStartAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedEndAt;

    /**
     * @var string|null $coverImage
     * @ORM\Column(name="cover_image", type="string", nullable=true)
     */
    private $coverImage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        parent::__construct();
        $this->isPublished = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntroContent(): ?string
    {
        return $this->introContent;
    }

    public function setIntroContent(string $content): self
    {
        $this->introContent = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getPublishedStartAt(): ?\DateTimeInterface
    {
        return $this->publishedStartAt;
    }

    public function setPublishedStartAt(?\DateTimeInterface $publishedStartAt): self
    {
        $this->publishedStartAt = $publishedStartAt;

        return $this;
    }

    public function getPublishedEndAt(): ?\DateTimeInterface
    {
        return $this->publishedEndAt;
    }

    public function setPublishedEndAt(?\DateTimeInterface $publishedEndAt): self
    {
        $this->publishedEndAt = $publishedEndAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    /**
     * @param string|null $coverImage
     */
    public function setCoverImage(?string $coverImage): void
    {
        $this->coverImage = $coverImage;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?UserInterface $author): AuthoredEntityInterface
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
