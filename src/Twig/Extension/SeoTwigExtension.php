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
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction('onl_render_title',
                [$this, 'renderTitle'],
                ['is_safe' => ['html'], 'needs_environment' => true]
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

    /**
     * @param \Twig_Environment $environment
     * @param SiteSettings $settings
     * @param AbstractPage|null $page
     * @param string $template
     * @return false|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderSeoMetadata(
        \Twig_Environment $environment,
        SiteSettings $settings,
        AbstractPage $page = null,
        $template = 'twig/seo-twig-extension/metadata.html.twig')
    {
        $builder = new SeoBuilderService($settings, $this->params, $page);
        $seo = $builder->build();

        $template = $environment->load($template);
        return $template->render([
            'seo' =>$seo
        ]);
    }



    public function getName()
    {
        return 'onl_seo';
    }
}