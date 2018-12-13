<?php

namespace App\Service;

use App\Entity\AbstractPage;
use App\Entity\Config\SiteSettings;
use App\Seo\Builder\TagBuilder;
use App\Seo\Factory\TagFactory;
use App\Seo\Model\MetaTag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SeoBuilderService
{
    private $settings;
    private $page;
    private $params;

    public function __construct(SiteSettings $settings, ParameterBagInterface $params, AbstractPage $page = null)
    {
        $this->settings = $settings;
        $this->page = $page;
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function build()
    {
        $builder = new TagBuilder(new TagFactory());
        //$builder->setTitle( $this->page->getTitle() ?? $this->settings->getSiteName());

//        $builder->addMeta(
//            'description',
//            MetaTag::NAME_TYPE,
//            'description',
//            $this->page->getSummary() ?? $this->settings->getDescription()
//        );
//
//        if(method_exists($this->page, 'getAuthor')) {
//            $builder->addMeta(
//                'author',
//                MetaTag::NAME_TYPE,
//                'author',
//                $this->settings->getAuthor()
//            );
//        } else {
//            $builder->addMeta(
//                'author',
//                MetaTag::NAME_TYPE,
//                'author',
//                $this->settings->getSiteName()
//            );
//        }
//
//        $builder->addMeta(
//            'author',
//            MetaTag::NAME_TYPE,
//            'author',
//            $this->settings->getSiteName()
//        );

        $seo = [];
        //$seo['site']['title'] = $this->page->getTitle() ?? $this->settings->getSiteName();


//
//        if(null !== $this->page->getLanguage() || "*" == $this->page->getLanguage()) $page->setLanguage($content->getLanguage());
//        if(null !== $content->getKeywords()) $page->setKeywords($content->getKeywords());
//        if(null !== $content->getAuthor()) $page->setAuthor($content->getAuthor());
//        if(null !== $content->getDescription()) $page->setDescription($content->getDescription());
//        if(null !== $content->getPublisher()) $page->setPublisher($content->getPublisher());
//
//        $page->setFacebook($content->getFacebook());
//        $page->setTwitter($content->getTwitter());

        return $seo;
    }
}