<?php

namespace App\Seo;

use App\Seo\Model\AbstractSeoGenerator;
use App\Seo\Model\MetaTag;

class TwitterSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setCard($content)
    {
        return $this->set('twitter:card', $content);
    }
    /**
     * @return MetaTag
     */
    public function getCard()
    {
        return $this->get('twitter:card');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        return $this->set('twitter:title', $content);
    }
    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->get('twitter:title');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSite($content)
    {
        return $this->set('twitter:site', $content);
    }
    /**
     * @return MetaTag
     */
    public function getSite()
    {
        return $this->get('twitter:site');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        return $this->set('twitter:description', $content);
    }
    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->get('twitter:description');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        return $this->set('twitter:image', $content);
    }
    /**
     * @return MetaTag
     */
    public function getImage()
    {
        return $this->get('twitter:image');
    }

    /**
     * @param string $type
     *
     * @return MetaTag
     */
    public function get($type)
    {
        return $this->tagBuilder->getMeta($type);
    }
    /**
     * @param string $type
     * @param string $value
     *
     * @return $this
     */
    public function set($type, $value)
    {
        $this->tagBuilder->addMeta($type)
            ->setType(MetaTag::NAME_TYPE)
            ->setValue($type)
            ->setContent((string) $value);
        return $this;
    }
}