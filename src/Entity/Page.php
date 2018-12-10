<?php

namespace App\Entity;

use App\Model\NodeTypeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

class Page implements NodeTypeInterface
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $slug;

    /**
     * @var string $language
     * @ORM\Column(type="string", length=10)
     */
    protected $language;

    /**
     * @var SeoMetadata $seoMetaData
     * @ORM\OneToOne(targetEntity="App\Entity\SeoMetadata")
     */
    protected $seoMetaData;

    /**
     * @var FacebookPageData $facebookMetaData
     * @ORM\OneToOne(targetEntity="App\Entity\FacebookPageData")
     */
    protected $facebookMetaData;

    /**
     * @var TwitterPageData $twitterMetaData
     * @ORM\OneToOne(targetEntity="App\Entity\TwitterPageData")
     */
    protected $twitterMetaData;

    public function __construct()
    {
        $this->language = "en_US";
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): NodeTypeInterface
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): NodeTypeInterface
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Page
     */
    public function setLanguage(string $language): Page
    {
        $this->language = $language;
        return $this;
    }
}
