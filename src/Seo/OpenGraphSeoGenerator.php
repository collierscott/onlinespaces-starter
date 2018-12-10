<?php

namespace App\Seo;

use App\Seo\Model\AbstractSeoGenerator;
use App\Seo\Model\MetaTag;

class OpenGraphSeoGenerator extends AbstractSeoGenerator
{
    /**
    * @param string $content
    *
    * @return $this
    */
    public function setType($content)
    {
        return $this->set('og:type', $content);
    }
    /**
     * @return MetaTag
     */
    public function getType()
    {
        return $this->get('og:type');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        return $this->set('og:title', $content);
    }
    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->get('og:title');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        return $this->set('og:description', $content);
    }
    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->get('og:description');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        $this->tagBuilder->addMeta('og:image')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('og:image')
            ->setContent((string) $content);
        return $this->set('og:image', $content);
    }
    /**
     * @return MetaTag
     */
    public function getImage()
    {
        return $this->get('og:image');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setUrl($content)
    {
        return $this->set('og:url', $content);
    }
    /**
     * @return MetaTag
     */
    public function getUrl()
    {
        return $this->get('og:url');
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