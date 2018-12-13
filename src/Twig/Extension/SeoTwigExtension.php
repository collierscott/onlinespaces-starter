<?php

namespace App\Twig\Extension;

use App\Entity\AbstractPage;
use App\Entity\Config\SiteSettings;
use App\Service\SeoBuilderService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SeoTwigExtension extends \Twig_Extension
{
    private $params;

    /**
     * SeoGeneratorProvider constructor.
     *
     * param array $generators
     * @param ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function getFunctions()
    {
        return [
             new \Twig_SimpleFunction('onl_render_seo_metadata',
                [$this, 'renderSeoMetadata'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction('onl_render_title',
                [$this, 'renderTitle'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction('onl_render_language',
                [$this, 'renderLanguage'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param SiteSettings $settings
     * @param AbstractPage|null $page
     * @return false|string
     */
    public function renderTitle(
        SiteSettings $settings,
        AbstractPage $page = null
    )
    {
        $builder = new SeoBuilderService($settings, $this->params, $page);
        return $builder->getTitle();
    }

    public function renderLanguage(
        SiteSettings $settings,
        AbstractPage $page = null
    )
    {
        $builder = new SeoBuilderService($settings, $this->params, $page);
        return substr($builder->getLanguage(), 0, 2);
    }

    /**
     * @param SiteSettings $settings
     * @param AbstractPage|null $page
     * @return false|string
     */
    public function renderSeoMetadata(
        SiteSettings $settings,
        AbstractPage $page = null
    )
    {
        $builder = new SeoBuilderService($settings, $this->params, $page);
        $builder->build();
        return $builder->render();
    }

    public function getName()
    {
        return 'onl_seo';
    }
}