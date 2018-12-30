<?php

namespace App\Seo\Provider;

use App\Seo\Model\AbstractSeoGenerator;

class SeoGeneratorProvider
{
    /** @var AbstractSeoGenerator[] */
    private $generators;

    public function __construct(array $generators)
    {
        $this->generators = $generators;
    }

    public function get($alias)
    {
        if (!isset($this->generators[$alias])) {
            throw new \InvalidArgumentException(sprintf('The SEO generator with alias "%s" is not defined.', $alias));
        }
        return $this->generators[$alias];
    }

    /**
     * @return AbstractSeoGenerator[]
     */
    public function getAll()
    {
        return $this->generators;
    }
    /**
     * @param $alias
     *
     * @return bool
     */
    public function has($alias)
    {
        return isset($this->generators[$alias]);
    }
}