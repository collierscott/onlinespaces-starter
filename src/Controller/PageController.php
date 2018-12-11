<?php

namespace App\Controller;

use App\Entity\Config\SiteSettings;
use App\Entity\Page;
use App\Repository\SiteSettingsRepository;
use App\Seo\BasicSeoGenerator;
use App\Seo\Builder\TagBuilder;
use App\Seo\Factory\TagFactory;
use App\Seo\OpenGraphSeoGenerator;
use App\Seo\Provider\SeoGeneratorProvider;
use App\Seo\TwitterSeoGenerator;
use App\Service\PageBuilderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    /** @var Page **/
    protected $page;

    /** @var SeoGeneratorProvider $seoProvider */
    protected $seoProvider;

    /**
     * PageController constructor.
     * @param SiteSettingsRepository $repository
     */
    public function __construct(SiteSettingsRepository $repository)
    {
        $tagBuilder = new TagBuilder(new TagFactory());
        $basicGenerator = new BasicSeoGenerator($tagBuilder);

        $tagBuilder = new TagBuilder(new TagFactory());
        $ogGenerator = new OpenGraphSeoGenerator($tagBuilder);

        $tagBuilder = new TagBuilder(new TagFactory());
        $twitterGenerator = new TwitterSeoGenerator($tagBuilder);

        $this->seoProvider = new SeoGeneratorProvider([
            'basic' => $basicGenerator,
            'og' => $ogGenerator,
            'twitter' => $twitterGenerator,
        ]);

        /** @var SiteSettings $settings */
        $settings = $repository->findOneBy(['id' => '1']);
        $service = new PageBuilderService();
        $page = $service->buildPage($settings);
        $this->page = $page;
    }
}