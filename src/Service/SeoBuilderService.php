<?php

namespace App\Service;

use App\Entity\AbstractPage;
use App\Entity\Config\SiteSettings;
use App\Seo\Builder\TagBuilder;
use App\Seo\Factory\TagFactory;
use App\Seo\Model\LinkTag;
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

    public function getTitle()
    {
        return $this->getValue('siteName','title', 'SITE_TITLE');
    }

    /**
     * @return array
     */
    public function build()
    {
        $builder = new TagBuilder(new TagFactory());
        $builder->setTitle($this->getValue('siteName','title', 'SITE_TITLE'));

        $builder->addMeta(
            'description',
            MetaTag::NAME_TYPE,
            'description',
            $this->getValue(
                'description',
                'summary',
                'SITE_DESCRIPTION'
            )
        );

        $builder->addMeta(
            'author',
            MetaTag::NAME_TYPE,
            'author',
            $this->getValue(
                'author',
                'author',
                'SITE_AUTHOR'
            )
        );

        $builder->addMeta(
            'language',
            MetaTag::NAME_TYPE,
            'language',
            $this->getValue(
                'language',
                'language',
                'SITE_LANGUAGE'
            )
        );

        $builder->addMeta(
            'keywords',
            MetaTag::NAME_TYPE,
            'keywords',
            $this->getValue(
                'keywords',
                'keywords',
                'SITE_KEYWORDS'
            )
        );

        $builder->addLink("publisher")
            ->setRel('publisher')
            ->setTitle($this->getValue('siteName','title', 'SITE_TITLE'))
            ->setHref(
                $this->getValue(
                    'publisher',
                    'publisher',
                    'SITE_PUBLISHER'
                )
            );

        $builder->addMeta('robots')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('robots')
            ->setContent(
                $this->getValue(
                    'robots',
                    'robots',
                    'SITE_ROBOTS'
                )
            );

        $seo = $builder->getTags();

//        $page->setFacebook($content->getFacebook());
//        $page->setTwitter($content->getTwitter());

        return $seo;
    }

    private function getValue(
        string $setting,
        string $property ,
        string $parameter
    )
    {
        if($this->page && $this->page->__get($property)) {
            return $this->page->__get($property);
        }

        if($this->settings && $this->settings->__get($setting)) {
            return $this->settings->__get($setting);
        }

        return getenv($parameter) ? getenv($parameter) : null;
    }
}