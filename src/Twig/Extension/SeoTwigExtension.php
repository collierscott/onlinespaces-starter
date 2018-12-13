<?php

namespace App\Twig\Extension;

use App\Entity\AbstractPage;

class SeoTwigExtension extends \Twig_Extension
{
    /**
     * SeoGeneratorProvider constructor.
     *
     * param array $generators
     */
    public function __construct()
    {
        //$this->generators = $generators;
    }

    public function getFunctions()
    {
        return [
             new \Twig_SimpleFunction('onl_render_seo_metadata',
                [$this, 'renderSeoMetadata'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
        ];
    }

    /**
     * @param \Twig_Environment $environment
     * @param AbstractPage $page
     * @param AbstractPage $content
     * @param string $template
     * @return false|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderSeoMetadata(
        \Twig_Environment $environment,
        AbstractPage $page,
        AbstractPage $content = null,
        $template = 'twig/seo-twig-extension/metadata.html.twig')
    {
        $seo['seo'] = $page->getSeoMetaData();
        $seo['og'] = $page->getFacebookMetaData();
        $seo['twitter'] = $page->getTwitterMetaData();

        $template = $environment->load($template);
        return $template->render([]);
    }



    public function getName()
    {
        return 'onl_seo';
    }
}