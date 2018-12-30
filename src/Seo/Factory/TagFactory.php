<?php

namespace App\Seo\Factory;

use App\Seo\Model\LinkTag;
use App\Seo\Model\MetaTag;
use App\Seo\Model\TitleTag;

class TagFactory
{
    /**
     * @return TitleTag
     */
    public function createTitle()
    {
        $titleTag = new TitleTag();
        return $titleTag;
    }
    /**
     * @return MetaTag
     */
    public function createMeta()
    {
        $metaTag = new MetaTag();
        return $metaTag;
    }
    /**
     * @return LinkTag
     */
    public function createLink()
    {
        $linkTag = new LinkTag();
        return $linkTag;
    }
}