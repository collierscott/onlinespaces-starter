<?php

namespace App\Controller;

use App\Entity\Config\SiteSettings;
use App\Repository\SiteSettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    /** @var SiteSettings **/
    protected $settings;

    /**
     * PageController constructor.
     * @param SiteSettingsRepository $repository
     */
    public function __construct(SiteSettingsRepository $repository)
    {
        /** @var SiteSettings $settings */
        $settings = $repository->findOneByMostRecentSettings();

        if(!$settings) {
            $settings = new SiteSettings();
        }
        $this->settings = $settings;
    }
}