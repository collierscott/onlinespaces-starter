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
     * @var Facebook|null $facebook
     */
    private $facebook;

    /**
     * @var Twitter|null $twitter
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
}
