<?php

namespace App\Service;

use App\Entity\Config\SiteSettings;
use App\Entity\AbstractPage;

class PageBuilderService
{
    public function buildPage(SiteSettings $settings = null)
    {
        $page = new AbstractPage();
        if($settings == null) {
            $settings = new SiteSettings();
            return $page;
        }

        $page->setSiteName($settings->getSiteName());
        $page->setTitle($settings->getSiteName());
        $page->setDescription($settings->getDescription());
        $page->setKeywords($settings->getKeywords());
        $page->setLanguage($settings->getLanguage());
        $page->setPublisher($this->url());

        $page->setFacebookAppId($settings->getFacebookAppId());
        $page->setFacebookPage($settings->getFacebookPage());
        $page->setFacebookAdmins($settings->getFacebookAdmins());
        $page->setFacebookProfileId($settings->getFacebookProfileId());

        $page->setTwitterUsername('@'.$settings->getTwitterUsername());

        $page->setGoogleId($settings->getGoogleId());

        $page->setSocialMetaData(self::buildSocialMetaData($page));

        return $page;
    }

    /**
     * @param AbstractPage $page
     * @param AbstractPage $content
     * @return AbstractPage
     */
    public static function buildPageFromContent(AbstractPage $content, $page)
    {
        if(null !== $content->getTitle()) $page->setTitle($content->getTitle());
        if(null !== $content->getLanguage() || "*" == $content->getLanguage()) $page->setLanguage($content->getLanguage());
        if(null !== $content->getKeywords()) $page->setKeywords($content->getKeywords());
        if(null !== $content->getAuthor()) $page->setAuthor($content->getAuthor());
        if(null !== $content->getDescription()) $page->setDescription($content->getDescription());
        if(null !== $content->getPublisher()) $page->setPublisher($content->getPublisher());

        $page->setFacebook($content->getFacebook());
        $page->setTwitter($content->getTwitter());
        $page->setSocialMetaData(self::buildSocialMetaData($page));

        return $page;
    }

    public function buildSocialMetaData(AbstractPage $page)
    {
        $data["og:locale"] = $page->getLanguage() ?? "en_US";
        //$data["og:type"] = $this->getFacebookType() ?? $this->metaContentType ?? "website";
        $data["og:site_name"] = $page->getSeoMetaData()->getSiteName();

        $data["og:title"] = $page->getTitle();
        $data["og:description"] = $page->getDescription();

        if(!empty($page->getFacebookAppId())) {
            $data["fb:app_id"] = $page->getFacebookAppId();
        }

        if(!empty($page->getFacebookProfileId())) {
            $data["fb:profile_id"] = $page->getFacebookProfileId();
        }

        if(!empty($page->getFacebookAdmins())) {
            $data["fb:admins"] = $page->getFacebookAdmins();
        }

        if(!empty($page->getFacebookPage())) {
            $data["fb:pages"] = $page->getFacebookPage();
        }

        if(null) {
            $data["og:url"] = self::url();
        }

        if(!empty($page->getFacebook())) {
            $facebook = $page->getFacebook();

            if(!empty($facebook->getUrl())) {
                $data["og:url"] = $facebook->getUrl();
            }

            if(!empty($facebook->getImage())) {
                $data["og:image"] = $facebook->getImage();

                if(!empty($facebook->getImageWidth())) {
                    $data["og:image:width" ] = $facebook->getImageWidth();
                }
                if(!empty($facebook->getImageHeight())) {
                    $data["og:image:height" ] = $facebook->getImageHeight();
                }
            }
        }

        $twitter = $page->getTwitter();

        $data["twitter:description"] = $twitter != null ? $twitter->getDescription() : $page->getDescription();
        $data["twitter:title"] = $twitter != null ? $twitter->getTitle() : $page->getTitle();

        $data["twitter:site"] = $page->getTwitterUsername();
        $data["twitter:creator"] = $page->getTwitterUsername();

        if(null != $twitter) {
            if(!empty($twitter->getCard())) {
                $data["twitter:card"] = $twitter->getCard();
            }

            if(!empty($twitter->getImage())) {
                $data["twitter:image"] = $twitter->getImage();
            }
        }

        return $data;
    }

    /**
     * @return string
     */
    private static function url()
    {
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}