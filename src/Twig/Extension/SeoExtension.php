<?php

namespace App\Twig\Extension;

use App\Seo\Model\AbstractSeoGenerator;
use App\Seo\Provider\SeoProvider;

class SeoExtension extends \Twig_Extension
{
    /**
     * @var AbstractSeoGenerator[]
     */
    protected $generators = [];
    /**
     * SeoGeneratorProvider constructor.
     *
     * param array $generators
     */
    public function __construct()
    {
        //$this->generators = $generators;
    }
    /**
     * @var SeoProvider $seoProvider;
     */
    protected $seoProvider;

//    /**
//     * param SeoPresentationInterface $seoPresentation
//     * @param SeoProvider $seoProvider
//     */
//    public function __construct(SeoProvider $seoProvider)
//    {
//        $this->seoProvider = $seoProvider;
//    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('onl_seo_metadata', [$this, 'seoMetadata'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @return string
     */
    public function seoMetadata()
    {
        return $this->seoProvider->render();
    }

    public function getName()
    {
        return 'onl_seo';
    }
}