<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @Vich\Uploadable()
 */
class ProfileImage
{
    use TimestampableEntity;
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var File|UploadedFile|null $file
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="url")
     * @Assert\NotBlank()
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $url;

    /**
     * ProfileImage constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return File|UploadedFile|null
     */
    public function getFile() : ?File
    {
        return $this->file;
    }

    /**
     * @param File|UploadedFile|null $file
     * @throws \Exception
     */
    public function setFile(?File $file= null): void
    {
        $this->file = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return '/images/' . $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function __toString(): string
    {
        return $this->id . ':' . $this->url;
    }
}