<?php

namespace App\Entity;

use App\Model\SeoMetadataInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeoMetadataRepository")
 * @ORM\Table(name="seo_meta_datas")
 */
class SeoMetadata implements SeoMetadataInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $title
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string|null $metaDescription
     * @ORM\Column(name="meta_description", type="string", nullable=true)
     */
    private $metaDescription;

    /**
     * @var string|null $metaKeywords
     * @ORM\Column(name="meta_keywords", type="string", nullable=true)
     */
    private $metaKeywords;

    /**
     * @var string|null $robots
     * @ORM\Column(type="string", nullable=true)
     */
    private $robots;

    /**
     * @var array $extraPorperties
     * @ORM\Column(name="extra_properties", type="json_array")
     */
    private $extraProperties;

    /**
     * @var array $extraNames
     * @ORM\Column(name="extra_names", type="json_array")
     */
    private $extraNames;

    /**
     * @var array$extraHttp
     * @ORM\Column(name="extra_http", type="json_array")
     */
    private $extraHttp;

    public function __construct()
    {
        $this->extraProperties = array();
        $this->extraNames = array();
        $this->extraHttp = array();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Gets the title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Updates the description.
     *
     * @param string $metaDescription
     */
    public function setMetaDescription(?string $metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * Gets the description for the meta tag.
     *
     * @return string
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * Sets the keywords.
     *
     * @param string $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * Gets the Keywords for the meta tag.
     *
     * @return string
     */
    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    /**
     * @return string|null
     */
    public function getRobots(): ?string
    {
        return $this->robots;
    }

    /**
     * @param string|null $robots
     */
    public function setRobots(?string $robots): void
    {
        $this->robots = $robots;
    }

    /**
     * @param array|\Traversable
     * @return SeoMetadata
     * @throws \InvalidArgumentException
     */
    public function setExtraProperties(array $extraProperties) : SeoMetadataInterface
    {
        $this->extraProperties = $this->toArray($extraProperties);
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraProperties(): array
    {
        return $this->extraProperties ?? array();
    }

    /**
     * Add a key-value pair for meta attribute property.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraProperty(string $key, string $value)
    {
        $this->extraProperties[$key] = $value;
    }

    public function removeExtraProperty($key)
    {
        if (array_key_exists($key, $this->extraProperties)) {
            unset($this->extraProperties[$key]);
        }
    }

    /**
     * @param array|\Traversable
     * @return SeoMetadataInterface
     */
    public function setExtraNames(array $extraNames) : SeoMetadataInterface
    {
        $this->extraNames = $extraNames;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraNames(): array
    {
        return $this->extraNames ?? array();
    }

    /**
     * Add a key-value pair for meta attribute name.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraName(string $key, string $value)
    {
        $this->extraNames[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function removeExtraName(string $key)
    {
        if (array_key_exists($key, $this->extraNames)) {
            unset($this->extraNames[$key]);
        }
    }

    /**
     * @param array|\Traversable
     * @return SeoMetadataInterface
     */
    public function setExtraHttp(array $extraHttp) : SeoMetadataInterface
    {
        $this->extraHttp = $extraHttp;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraHttp(): array
    {
        return $this->extraHttp ?? array();
    }

    /**
     * @param string $key
     */
    public function removeExtraHttp(string $key)
    {
        if (array_key_exists($key, $this->extraHttp)) {
            unset($this->extraHttp[$key]);
        }
    }

    /**
     * Add a key-value pair for meta attribute http-equiv.
     *
     * @param string $key
     * @param string $value
     */
    public function addExtraHttp(string $key, string $value)
    {
        $this->extraHttp[$key] = $value;
    }

    /**
     * Extract an array out of $data or throw an exception if not possible.
     *
     * @param array||\Traversable $data something that can be converted to an array
     *
     * @return array Native array representation of $data
     *
     * @throws \InvalidArgumentException
     */
    private function toArray($data)
    {
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof \Traversable) {
            return iterator_to_array($data);
        }

        throw new \InvalidArgumentException(
            sprintf('Expected array or Traversable, got "%s"',
                is_object($data) ? get_class($data) : gettype($data)));
    }
}
