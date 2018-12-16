<?php

namespace App\DataFixtures;

use App\Entity\Config\SiteSettings;
use Doctrine\Common\Persistence\ObjectManager;

class SiteSettingsFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $settings = new SiteSettings();
        $settings->setDescription('This is a bootstrapper project');
        $settings->setSiteName('Onlinespaces Bootstrapper');
        $settings->setLanguage('en_US');
        $settings->setContentType('website');
        $settings->setFacebookAppId('123456');
        $settings->setFacebookAdmins('@onlinespaces');
        $settings->setFacebookPage('onlinespaces');
        $settings->setFacebookProfileId('@onlinespaces');
        $settings->setTwitterUsername('@onlinespaces');
        $settings->setServerTimeZone('UTC');
        $settings->setFacebookType('article');
        $settings->setGoogleId('123456');

        $manager->persist($settings);
        $manager->flush();
    }
}