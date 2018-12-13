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
    private $builder;

    public function __construct(SiteSettings $settings, ParameterBagInterface $params, AbstractPage $page = null)
    {
        $this->settings = $settings;
        $this->page = $page;
        $this->params = $params;
        $this->builder = new TagBuilder(new TagFactory());
    }

    public function getTitle()
    {
        return $this->getValue('siteName','title', 'SITE_TITLE');
    }

    public function getLanguage()
    {
        return $this->getValue(
            'language',
            'language',
            'SITE_LANGUAGE'
        );
    }

    /**
     * @return array
     */
    public function build()
    {
        $title = $this->getValue('siteName','title', 'SITE_TITLE');
        $description = $this->getValue(
            'description',
            'summary',
            'SITE_DESCRIPTION'
        );

        $author = $this->getValue(
            'author',
            'author',
            'SITE_AUTHOR'
        );

        $language = $this->getValue(
            'language',
            'language',
            'SITE_LANGUAGE'
        );

        $this->builder->setTitle($title);
        $this->builder->addMeta('description')
            ->setType(MetaTag::NAME_TYPE)
            ->setContent($description)
            ->setValue('description');

        $this->builder->addMeta('author')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('author')
            ->setContent($author);

        $this->builder->addMeta('language')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('language')
            ->setContent($language);

        $this->builder->addMeta(
            'keywords',
            MetaTag::NAME_TYPE,
            'keywords',
            $this->getValue(
                'keywords',
                'keywords',
                'SITE_KEYWORDS'
            )
        );

        $this->builder->addLink("publisher")
            ->setRel('publisher')
            ->setTitle($this->getValue('siteName','title', 'SITE_TITLE'))
            ->setHref(
                $this->getValue(
                    'publisher',
                    'publisher',
                    'SITE_PUBLISHER'
                )
            );

        $this->builder->addMeta('robots')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('robots')
            ->setContent(
                $this->getValue(
                    'robots',
                    'robots',
                    'SITE_ROBOTS'
                )
            );

        $this->builder->addMeta('og:locale');
        //$seo = $builder->getTags();

//        $page->setFacebook($content->getFacebook());
//        $page->setTwitter($content->getTwitter());

        return $this->builder->getTags();
    }

    public function render()
    {
        return $this->builder->render();
    }

    public function __toString()
    {
        return $this->builder->render();
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