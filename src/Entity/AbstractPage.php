<?php

namespace App\Entity;

use App\Model\ContentInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

class AbstractPage implements ContentInterface
{
    /**
     * @var string $title
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true, name="page_title")
     */
    protected $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="summary")
     */
    private $summary;

    /**
     * @var string $slug
     *
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

    /**
     * @param string $title
     * @return ContentInterface
     */
    public function setTitle(string $title): ContentInterface
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPageTitle(): ?string
    {
        return $this->pageTitle;
    }

    /**
     * @param string|null $pageTitle
     */
    public function setPageTitle(?string $pageTitle): void
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return AbstractPage
     */
    public function setSummary(string $summary): AbstractPage
    {
        $this->summary = $summary;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): ContentInterface
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
     * @return ContentInterface
     */
    public function setLanguage(string $language): ContentInterface
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return SeoMetadata
     */
    public function getSeoMetaData(): SeoMetadata
    {
        return $this->seoMetaData;
    }

    /**
     * @param SeoMetadata $seoMetaData
     */
    public function setSeoMetaData(SeoMetadata $seoMetaData): void
    {
        $this->seoMetaData = $seoMetaData;
    }

    /**
     * @return FacebookPageData
     */
    public function getFacebookMetaData(): ?FacebookPageData
    {
        return $this->facebookMetaData;
    }

    /**
     * @param FacebookPageData $facebookMetaData
     */
    public function setFacebookMetaData(FacebookPageData $facebookMetaData): void
    {
        $this->facebookMetaData = $facebookMetaData;
    }

    /**
     * @return TwitterPageData
     */
    public function getTwitterMetaData(): ?TwitterPageData
    {
        return $this->twitterMetaData;
    }

    /**
     * @param TwitterPageData $twitterMetaData
     */
    public function setTwitterMetaData(TwitterPageData $twitterMetaData): void
    {
        $this->twitterMetaData = $twitterMetaData;
    }

    public function getAuthor()
    {
        return '';
    }

    public function __get($name)
    {
        if($name === 'seoMetaData->metaKeywords') {
            dd($this->$name);
        }

        if(method_exists($this, $name)){
         return $this->{$name};
        }

        return null;
    }
}
