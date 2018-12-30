<?php

namespace App\Entity\Config;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteSettingsRepository")
 * @ORM\Table(name="site_settings")
 */
class SiteSettings
{
    const ACCESS_LEVELS = [
        'Public' => 1,
        'Guest' => 0,
        'Registered' => 2,
        'Administrator' => 3,
        'Super Administrator' => 4,
    ];

    const STATUS = [
        'Published' => 1,
        'Unpublished' => 0,
        'Trashed' => -1,
        'Draft' => 2,
        'Archived' => 3,
    ];

    const LIMITS = [
        '5' => 5,
        '10' => 10,
        '15' => 15,
        '20' => 20,
        '25' => 25,
        '30' => 30,
        '50' => 50,
        '100' => 100,
    ];

    const ROBOTS = [
        'Index, Follow' => 'index, follow',
        'No Index, Follow' => 'noindex, follow',
        'Index, No Follow' => 'index, nofollow',
        'No Index, No Follow' => 'noindex, nofollow',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siteName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSiteOffline;

    /**
     * @ORM\Column(type="integer")
     */
    private $accessLevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $listLimit;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $contentType;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $robots;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contentRights;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempFolder;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $serverTimeZone;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $language;

    /**
     * The Facebook app ID of the site's app.
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $facebookAppId;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $facebookPixelId;

    /**
     * Find out the type of your object in the Action Type section of App Dashboard. Select the object and find its
     * og:type under Advanced. Once an object is published in a story its type can't be changed.
     *
     * @ORM\Column(type="string", length=20)
     */
    private $facebookType;

    /**
     * Seconds until this page should be re-scraped. Use this to rate limit the Facebook content crawlers.
     * The minimum allowed value is 345600 seconds (4 days); if you set a lower value, the minimum will be used.
     * If you do not include this tag, the ttl will be computed from the "Expires" header returned by your web server,
     * otherwise it will default to 7 days.
     *
     * @ORM\Column(type="integer")
     */
    private $facebookTtl;

    /**
     * The ID (or comma-separated list for properties that can accept multiple IDs) of an app, person using the app,
     * or Page Graph API object.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookAdmins;

    /**
     * The ID (or comma-separated list for properties that can accept multiple IDs) of an app,
     * person using the app, or Page Graph API object.
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $facebookProfileId;

    /**
     * One or more Facebook Page IDs that are associated with a URL in order to enable link editing and
     * instant article publishing.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookPage;

    /**
     * The "@username" for the website used in the card footer.
     * The "@username" for the content creator / author.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitterUsername;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $googleId;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $layout;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $defaultImage;

    public function __construct()
    {
        $this->isSiteOffline = false;
        $this->accessLevel = 1;
        $this->listLimit = 25;
        $this->contentType = "web";
        $this->robots = "index, follow";
        $this->tempFolder = __DIR__ . "/../../../var/temp/";
        $this->serverTimeZone = "UTC";
        $this->language = "en_US";
        $this->facebookType = "website";
        $this->facebookTtl = 604800;
        $this->layout = "default";
        $this->defaultImage = getenv('DEFAULT_IMAGE') ? getenv('DEFAULT_IMAGE') : 'uploads/default_image.jpg';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsSiteOffline(): ?bool
    {
        return $this->isSiteOffline;
    }

    public function setIsSiteOffline(bool $isSiteOffline): self
    {
        $this->isSiteOffline = $isSiteOffline;

        return $this;
    }

    public function getAccessLevel(): ?int
    {
        return $this->accessLevel;
    }

    public function setAccessLevel(int $accessLevel): self
    {
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function getListLimit(): ?int
    {
        return $this->listLimit;
    }

    public function setListLimit(int $listLimit): self
    {
        $this->listLimit = $listLimit;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getRobots(): ?string
    {
        return $this->robots;
    }

    public function setRobots(string $robots): self
    {
        $this->robots = $robots;

        return $this;
    }

    public function getContentRights(): ?string
    {
        return $this->contentRights;
    }

    public function setContentRights(?string $contentRights): self
    {
        $this->contentRights = $contentRights;

        return $this;
    }

    public function getTempFolder(): ?string
    {
        return $this->tempFolder;
    }

    public function setTempFolder(string $tempFolder): self
    {
        $this->tempFolder = $tempFolder;

        return $this;
    }

    public function getServerTimeZone(): ?string
    {
        return $this->serverTimeZone;
    }

    public function setServerTimeZone(string $serverTimeZone): self
    {
        $this->serverTimeZone = $serverTimeZone;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getFacebookAppId(): ?string
    {
        return $this->facebookAppId;
    }

    public function setFacebookAppId(?string $facebookAppId): self
    {
        $this->facebookAppId = $facebookAppId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebookPixelId(): ?string
    {
        return $this->facebookPixelId;
    }

    /**
     * @param string|null $facebookPixelId
     * @return SiteSettings
     */
    public function setFacebookPixelId(?string $facebookPixelId): SiteSettings
    {
        $this->facebookPixelId = $facebookPixelId;
        return $this;
    }

    public function getFacebookType(): ?string
    {
        return $this->facebookType;
    }

    public function setFacebookType(string $facebookType): self
    {
        $this->facebookType = $facebookType;

        return $this;
    }

    public function getFacebookTtl(): ?int
    {
        return $this->facebookTtl;
    }

    public function setFacebookTtl(int $facebookTtl): self
    {
        $this->facebookTtl = $facebookTtl;

        return $this;
    }

    public function getFacebookAdmins(): ?string
    {
        return $this->facebookAdmins;
    }

    public function setFacebookAdmins(?string $facebookAdmins): self
    {
        $this->facebookAdmins = $facebookAdmins;

        return $this;
    }

    public function getFacebookProfileId(): ?string
    {
        return $this->facebookProfileId;
    }

    public function setFacebookProfileId(string $facebookProfileId): self
    {
        $this->facebookProfileId = $facebookProfileId;

        return $this;
    }

    public function getFacebookPage(): ?string
    {
        return $this->facebookPage;
    }

    public function setFacebookPage(?string $facebookPage): self
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    public function getTwitterUsername(): ?string
    {
        return $this->twitterUsername;
    }

    public function setTwitterUsername(?string $twitterUsername): self
    {
        $this->twitterUsername = $twitterUsername;

        return $this;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): self
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }

    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getDefaultImage(): ?string
    {
        return $this->defaultImage;
    }

    /**
     * @param string $defaultImage
     * @return SiteSettings
     */
    public function setDefaultImage(string $defaultImage): SiteSettings
    {
        $this->defaultImage = $defaultImage;
        return $this;
    }
}
