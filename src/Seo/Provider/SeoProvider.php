<?php

namespace App\Seo\Provider;

class SeoProvider
{
    public function get($alias)
    {
        if (!isset($this->generators[$alias])) {
            throw new \InvalidArgumentException(sprintf('The SEO generator with alias "%s" is not defined.', $alias));
        }
        return $this->generators[$alias];
    }
}