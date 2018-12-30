<?php

namespace App\DataFixtures;

use App\Entity\Config\SiteSettings;
use Doctrine\Common\Persistence\ObjectManager;

class SiteSettingsFixtures extends BaseFixture
{
    private $settings;

    public function __construct()
    {
        $this->settings = new SiteSettings();
    }

    protected function loadData(ObjectManager $manager)
    {
        $setting = $this->getValue(
            'siteDescription',
            'SITE_DESCRIPTION'
        );
        $this->settings->setDescription($setting);

        $setting = $this->getValue(
            'siteName',
            'SITE_NAME'
        );
        $this->settings->setSiteName($setting);

        $setting = $this->getValue(
            'siteName',
            'SITE_LANGUAGE'
        );
        $this->settings->setLanguage($setting);

        $setting = $this->getValue(
            'contentType',
            'SITE_TYPE'
        );
        $this->settings->setContentType($setting);

        $setting = $this->getValue(
            'facebookAppId',
            'FACEBOOK_APP_ID'
        );
        $this->settings->setFacebookAppId($setting);

        $setting = $this->getValue(
            'facebookPixelId',
            'FACEBOOK_PIXEL_ID'
        );
        $this->settings->setFacebookPixelId($setting);

        $setting = $this->getValue(
            'facebookAdmins',
            'FACEBOOK_ADMINS'
        );
        $this->settings->setFacebookAdmins($setting);

        $setting = $this->getValue(
            'facebookAdmins',
            'FACEBOOK_PAGE'
        );
        $this->settings->setFacebookPage($setting);

        $setting = $this->getValue(
            'facebookProfileId',
            'FACEBOOK_PROFILE_ID'
        );
        $this->settings->setFacebookProfileId($setting);

        $setting = $this->getValue(
            'facebookType',
            'FACEBOOK_TYPE'
        );
        $this->settings->setFacebookType($setting);

        $setting = $this->getValue(
            'twitterUsername',
            'TWITTER_USERNAME'
        );
        $this->settings->setTwitterUsername($setting);

        $setting = $this->getValue(
            'serverTimeZone',
            'SERVER_TIME_ZONE'
        );
        $this->settings->setServerTimeZone($setting);

        $setting = $this->getValue(
            'googleId',
            'GOOGLE_ANALYTICS_ID'
        );
        $this->settings->setGoogleId($setting);

        $manager->persist($this->settings);
        $manager->flush();
    }

    private function getValue(
        string $setting,
        string $parameter
    )
    {
//        if($this->settings && $this->settings->__get($setting)) {
//            return $this->settings->__get($setting);
//        }

        return getenv($parameter) ? getenv($parameter) : null;
    }
}