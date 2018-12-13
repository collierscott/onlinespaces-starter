<?php

namespace App\Model;

interface SeoMetadataInterface
{
    /**
     * Updates the description.
     *
     * @param string $metaDescription
     */
    public function setMetaDescription(?string $metaDescription);

    /**
     * Gets the description for the meta tag.
     *
     * @return string
     */
    public function getMetaDescription() :?string;

    /**
     * Sets the keywords.
     *
     * @param string $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords);

    /**
     * Gets the Keywords for the meta tag.
     *
     * @return string
     */
    public function getMetaKeywords() :?string;

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle(string $title);

    /**
     * Gets the title.
     *
     * @return string
     */
    public function getTitle() : string;

    /**
     * @param array|\Traversable
     */
    public function setExtraProperties(array $extraProperties);

    /**
     * @param array|\Traversable
     */
    public function setExtraNames(array $extraNames);

    /**
     * @param array|\Traversable
     */
    public function setExtraHttp(array $extraHttp);

    /**
     * @return array
     */
    public function getExtraProperties() : array;

    /**
     * @return array
     */
    public function getExtraNames() : array;

    /**
     * @return array
     */
    public function getExtraHttp() : array;

    /**
     * Add a key-value pair for meta attribute property.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraProperty(string $key, string $value);

    /**
     * Add a key-value pair for meta attribute name.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraName(string $key, string $value);

    /**
     * Add a key-value pair for meta attribute http-equiv.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraHttp(string $key, string $value);
}