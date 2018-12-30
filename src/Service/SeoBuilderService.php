<?php

namespace App\Service;

use App\Entity\AbstractPage;
use App\Entity\Config\SiteSettings;
use App\Seo\BasicSeoGenerator;
use App\Seo\Builder\TagBuilder;
use App\Seo\FacebookSeoGenerator;
use App\Seo\Factory\TagFactory;
use App\Seo\Model\AbstractSeoGenerator;
use App\Seo\OpenGraphSeoGenerator;
use App\Seo\TwitterSeoGenerator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SeoBuilderService
{
    private $settings;
    private $page;
    private $params;
    private $generators;

    public function __construct(SiteSettings $settings, ParameterBagInterface $params, AbstractPage $page = null)
    {
        $this->settings = $settings;
        $this->page = $page;
        $this->params = $params;

        $this->generators['basic'] = new BasicSeoGenerator(new TagBuilder(new TagFactory()));
        $this->generators['og'] = new OpenGraphSeoGenerator(new TagBuilder(new TagFactory()));
        $this->generators['twitter'] = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
        $this->generators['facebook'] = new FacebookSeoGenerator(new TagBuilder(new TagFactory()));
    }

    public function getTitle()
    {
        return $this->getValue('siteName','title', 'SITE_TITLE');
    }

    public function getLanguage()
    {
        return $this->getValue(
            'language',
            'language',
            'SITE_LANGUAGE'
        );
    }

    /**
     * @return array
     */
    public function build()
    {
        $title = $this->getValue('siteName','title', 'SITE_TITLE');

        $description = $this->getValue(
            'description',
            'metaDescription',
            'SITE_DESCRIPTION'
        );

        $author = $this->getValue(
            'author',
            'author',
            'SITE_AUTHOR'
        );

        $language = $this->getValue(
            'language',
            'language',
            'SITE_LANGUAGE'
        );

        $keywords = $this->getValue(
            'keywords',
            'seoMetaData->metaKeywords',
            'SITE_KEYWORDS'
        );

        $robots = $this->getValue(
            'robots',
            'robots',
            'SITE_ROBOTS'
        );

        $publisher = $this->getValue(
            'publisher',
            'publisher',
            'SITE_PUBLISHER'
        );

        $creator = $this->getValue(
            'twitter',
            'twitter',
            'SITE_TWITTER'
        );

        $siteName = $this->getValue(
            'siteName',
            'siteName',
            'SITE_NAME'
        );

        $type = $this->getValue(
            'type',
            'type',
            'SITE_TYPE'
        );

        $image = $this->getValue(
            'defaultImage',
            'defaultImage',
            'DEFAULT_IMAGE'
        );

        $url = $this->url();

        /** @var BasicSeoGenerator $basic */
        $basic = $this->generators['basic'];
        /** @var OpenGraphSeoGenerator $og */
        $og = $this->generators['og'];
        /** @var TwitterSeoGenerator $twitter */
        $twitter = $this->generators['twitter'];
        /** @var FacebookSeoGenerator $facebook */
        $facebook = $this->generators['facebook'];

        $shouldFollow = !stripos($robots, 'nofollow');
        $shouldIndex = !stripos($robots, 'noindex');

        $description = substr($description, 0, 150);

        //$basic->setTitle($title);
        $basic->setDescription($description);
        $basic->setKeywords($keywords);
        $basic->setRobots($shouldIndex, $shouldFollow);
        $basic->setCanonical($url);
        $basic->setAuthor($author);
        $basic->setSummary($description);
        $basic->setLanguage($language);

        $og->setDescription($description);
        $og->setTitle($title);
        $og->setType($type);
        $og->setUrl($url);
        $og->setSiteName($siteName);
        $og->setImage($this->imageUrl() . '/' . $image);
        $og->set('og:image:url', $this->imageUrl() . '/' . $image);
        $og->set('og:image:secure_url', $this->imageUrl(true) . '/' . $image);

        try {
            list($width, $height, $type, $attr) = getimagesize(dirname(__DIR__) . '/../public/' . $image);
            $og->set('og:image:width', $width);
            $og->set('og:image:height', $height);
            $og->set('og:image:type', image_type_to_mime_type($type));
        } catch (\Exception $e) {
        }

        if($this->settings->getFacebookAppId()) {
            $facebook->setAppId($this->settings->getFacebookAppId());
        }

        if($this->settings->getFacebookProfileId()) {
            $facebook->setProfileId($this->settings->getFacebookProfileId());
        }

        if($this->settings->getFacebookAdmins()) {
            $facebook->setAdmins($this->settings->getFacebookAdmins());
        }

        if($this->settings->getFacebookPage()) {
            $facebook->setPages($this->settings->getFacebookPage());
        }

//        if($this->page && !empty($this->page->getFacebookMetaData())) {
//            $facebook = $this->page->getFacebookMetaData();
//
//            if(!empty($facebook->getImage())) {
//                $data["og:image"] = $facebook->getImage();
//
//                if(!empty($facebook->getImageWidth())) {
//                    $data["og:image:width" ] = $facebook->getImageWidth();
//                }
//                if(!empty($facebook->getImageHeight())) {
//                    $data["og:image:height" ] = $facebook->getImageHeight();
//                }
//            }
//        }

        $twitter->setTitle($title);
        $twitter->setDescription($description);
        $twitter->setSite($creator);
        $twitter->setCard($creator);
        $twitter->setCreator($creator);

        return $this->generators;
    }

    public function render()
    {
        $output = '';
        /** @var AbstractSeoGenerator $generator */
        foreach ($this->generators as $generator) {
            $output .= $generator->render() . PHP_EOL;
        }
        return $output;
    }

    public function __toString()
    {
        return $this->render();
    }

    private function getValue(
        string $setting,
        string $property ,
        string $parameter
    )
    {
//        if($this->page && property_exists($this->page, $property)) {
//            dd($this->page);
//            dd($this->page->{$property});
//            return $this->page->{$property};
//        }

        if($this->settings && $this->settings->__get($setting)) {
            return $this->settings->__get($setting);
        }

        return getenv($parameter) ? getenv($parameter) : null;
    }

    /**
 * @return string
 */
    private function url()
    {
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * @param bool $secure
     * @return string
     */
    private function imageUrl($secure = false)
    {
        $protocol = "http";

        if($secure) {
            $protocol = "https";
        }

        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }
}