<?php

namespace App\Model;

interface SeoAwareInterface
{
    /**
     * @return SeoMetadataInterface
     */
    public function getSeoMetadata();

    /**
     * @param SeoMetadataInterface $seoMetadata
     * @return array|SeoMetadataInterface $metadata
     */
    public function setSeoMetadata(SeoMetadataInterface $seoMetadata);
}