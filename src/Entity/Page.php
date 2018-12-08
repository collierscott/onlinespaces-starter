<?php

namespace App\Entity;

class Page
{
    private $title;

    private $siteName;

    private $description;

    /**
     * @var string|null $keywords
     */
    private $keywords;

    /**
     * @var string|null $author
     */
    private $author;

    /**
     * @var string $language
     */
    private $language;

    /**
     * @var string|null $publisher
     */
    private $publisher;

    /**
     * The "@username" for the website used in the card footer.
     * The "@username" for the content creator / author.
     *
     * @var string|null $twitterUsername
     */
    private $twitterUsername;

    /**
     * @var string|null $googleId
     */
    private $googleId;

    /**
     * @var string[]|null $socialMetaData
     */
    private $socialMetaData;

    /**
     * @var FacebookPageData|null $facebook
     */
    private $facebook;

    /**
     * @var TwitterPageData|null $twitter
     */
    private $twitter;

    /**
     * @var string|null $facebookAppId
     */
    private $facebookAppId;

    /**
     * @var string|null $facebookProfileId
     */
    private $facebookProfileId;

    /**
     * @var string|null $facebookAdmins
     */
    private $facebookAdmins;

    /**
     * @var string|null $facebookPage
     */
    private $facebookPage;

    public function __construct()
    {
        $this->language = "en_US";
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

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     * @return Page
     */
    public function setKeywords(?string $keywords): Page
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return Page
     */
    public function setAuthor(?string $author): Page
    {
        $this->author = $author;
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

    /**
     * @return string|null
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * @param string|null $publisher
     * @return Page
     */
    public function setPublisher(?string $publisher): Page
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterUsername(): ?string
    {
        return $this->twitterUsername;
    }

    /**
     * @param string|null $twitterUsername
     * @return Page
     */
    public function setTwitterUsername(?string $twitterUsername): Page
    {
        $this->twitterUsername = $twitterUsername;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    /**
     * @param string|null $googleId
     * @return Page
     */
    public function setGoogleId(?string $googleId): Page
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getSocialMetaData(): ?array
    {
        return $this->socialMetaData;
    }

    /**
     * @param string[]|null $socialMetaData
     * @return Page
     */
    public function setSocialMetaData(?array $socialMetaData): Page
    {
        $this->socialMetaData = $socialMetaData;
        return $this;
    }

    /**
     * @return FacebookPageData|null
     */
    public function getFacebook(): ?FacebookPageData
    {
        return $this->facebook;
    }

    /**
     * @param FacebookPageData|null $facebook
     * @return Page
     */
    public function setFacebook(?FacebookPageData $facebook): Page
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * @return TwitterPageData|null
     */
    public function getTwitter(): ?TwitterPageData
    {
        return $this->twitter;
    }

    /**
     * @param TwitterPageData|null $twitter
     * @return Page
     */
    public function setTwitter(?TwitterPageData $twitter): Page
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebookAppId(): ?string
    {
        return $this->facebookAppId;
    }

    /**
     * @param string|null $facebookAppId
     * @return Page
     */
    public function setFacebookAppId(?string $facebookAppId): Page
    {
        $this->facebookAppId = $facebookAppId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebookProfileId(): ?string
    {
        return $this->facebookProfileId;
    }

    /**
     * @param string|null $facebookProfileId
     * @return Page
     */
    public function setFacebookProfileId(?string $facebookProfileId): Page
    {
        $this->facebookProfileId = $facebookProfileId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebookAdmins(): ?string
    {
        return $this->facebookAdmins;
    }

    /**
     * @param string|null $facebookAdmins
     * @return Page
     */
    public function setFacebookAdmins(?string $facebookAdmins): Page
    {
        $this->facebookAdmins = $facebookAdmins;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebookPage(): ?string
    {
        return $this->facebookPage;
    }

    /**
     * @param string|null $facebookPage
     * @return Page
     */
    public function setFacebookPage(?string $facebookPage): Page
    {
        $this->facebookPage = $facebookPage;
        return $this;
    }
}
