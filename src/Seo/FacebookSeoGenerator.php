<?php

namespace App\Seo;

use App\Seo\Model\MetaTag;
use App\Seo\Model\AbstractSeoGenerator;

class FacebookSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setPageId($content)
    {
        return $this->set('fb:page_id', $content);
    }

    /**
     * @return MetaTag
     */
    public function getPageId()
    {
        return $this->get('fb:page_id');
    }

    /**
     * @param $content
     * @return $this
     */
    public function setAppId($content)
    {
        return $this->set('fb:app_id', $content);
    }

    /**
     * @return MetaTag
     */
    public function getAppId()
    {
        return $this->get('fb:app_id');
    }

    /**
     * @param $content
     * @return $this
     */
    public function setProfileId($content)
    {
        return $this->set('fb:profile_id', $content);
    }

    /**
     * @return MetaTag
     */
    public function getProfileId()
    {
        return $this->get('fb:profile_id');
    }

    /**
     * @param $content
     * @return $this
     */
    public function setAdmins($content)
    {
        return $this->set('fb:admins', $content);
    }

    /**
     * @return MetaTag
     */
    public function getAdmins()
    {
        return $this->get('fb:admins');
    }

    /**
     * @param $content
     * @return $this
     */
    public function setPages($content)
    {
        return $this->set('fb:pages', $content);
    }

    /**
     * @return MetaTag
     */
    public function getPages()
    {
        return $this->get('fb:pages');
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