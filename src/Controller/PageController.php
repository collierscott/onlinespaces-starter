<?php

namespace App\Controller;

use App\Entity\Config\SiteSettings;
use App\Entity\AbstractPage;
use App\Repository\SiteSettingsRepository;
use App\Seo\Provider\SeoGeneratorProvider;
use App\Service\PageBuilderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    /** @var AbstractPage **/
    protected $page;

    /** @var SeoGeneratorProvider $seoProvider */
    protected $seoProvider;

    /**
     * PageController constructor.
     * @param SiteSettingsRepository $repository
     */
    public function __construct(SiteSettingsRepository $repository)
    {
        /** @var SiteSettings $settings */
        $settings = $repository->findOneBy(['id' => '1']);
        $service = new PageBuilderService();
        $page = $service->buildPage($settings);
        $this->page = $page;
    }
}