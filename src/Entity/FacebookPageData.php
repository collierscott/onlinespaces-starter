<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * https://developers.facebook.com/docs/sharing/opengraph/object-properties
 *
 * @ORM\Entity(repositoryClass="App\Repository\FacebookPageDataRepository")
 * @ORM\Table(name="facebook_data")
 */
class FacebookPageData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The URL of the object, which acts as the canonical URL. Usually the same URL as the page where
     * property tags are placed.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * The title, headline or name of the object. Ideal is about 5 words.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * A short description or summary of the object.
     * 80 characters is ideal.
     *
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $description;

    /**
     * The language locale that object properties use. The default is en_US.
     *
     * @ORM\Column(type="string", length=10)
     */
    private $local;

    /**
     * <meta property="og:image"            content="http://food.png">
     * <meta property="og:image:secure_url" content="https://food.png">
     * <meta property="og:image:type"       content="image/png">
     * <meta property="og:image:width"      content="200">
     * <meta property="og:image:height"     content="500">
     */

    /**
     * The URL of the image for your object. It should be at least 600x315 pixels,
     * but 1200x630 or larger is preferred (up to 5MB). Stay close to a 1.91:1 aspect ratio to avoid cropping.
     * Game icons should be square and at least 600x600 pixels. You can include multiple og:image tags if you have
     * multiple resolutions available. If you update the image after publishing, use a new URL because images are
     * cached based on the URL and might not update otherwise.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * https:// URL for the image
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageSecureUrl;

    /**
     * MIME type of the image. One of image/jpeg, image/gif or image/png
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imageType;

    /**
     * Width of image in pixels.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageWidth;

    /**
     * Height of image in pixels.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageHeight;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->local = 'en_US';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(string $local): self
    {
        $this->local = $local;

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

    public function getImageSecureUrl(): ?string
    {
        return $this->imageSecureUrl;
    }

    public function setImageSecureUrl(?string $imageSecureUrl): self
    {
        $this->imageSecureUrl = $imageSecureUrl;

        return $this;
    }

    public function getImageType(): ?string
    {
        return $this->imageType;
    }

    public function setImageType(?string $imageType): self
    {
        $this->imageType = $imageType;

        return $this;
    }

    public function getImageWidth(): ?int
    {
        return $this->imageWidth;
    }

    public function setImageWidth(?int $imageWidth): self
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    public function getImageHeight(): ?int
    {
        return $this->imageHeight;
    }

    public function setImageHeight(?int $imageHeight): self
    {
        $this->imageHeight = $imageHeight;

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
