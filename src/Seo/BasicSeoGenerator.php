<?php

namespace App\Seo;

use App\Seo\Model\AbstractSeoGenerator;
use App\Seo\Model\MetaTag;
use App\Seo\Model\TitleTag;

class BasicSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        $this->tagBuilder->setTitle($content);
        return $this;
    }

    /**
     * @return TitleTag
     */
    public function getTitle()
    {
        return $this->tagBuilder->getTitle();
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        $this->tagBuilder->addMeta('description')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('description')
            ->setContent((string) $content);
        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->tagBuilder->getMeta('description');
    }

    /**
     * @param string $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->tagBuilder->addMeta('keywords')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('keywords')
            ->setContent((string) $keywords);
        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getKeywords()
    {
        return $this->tagBuilder->getMeta('keywords');
    }

    /**
     * @param bool $shouldIndex
     * @param bool $shouldFollow
     *
     * @return $this
     */
    public function setRobots($shouldIndex, $shouldFollow)
    {
        $index = $shouldIndex ? 'index' : 'noindex';
        $follow = $shouldFollow ? 'follow' : 'nofollow';
        $this->tagBuilder->addMeta('robots')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('robots')
            ->setContent(sprintf('%s, %s', $index, $follow));
        return $this;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setCanonical($url)
    {
        $this->tagBuilder->addLink('canonical')
            ->setHref((string) $url)
            ->setRel('canonical');
        return $this;
    }
}