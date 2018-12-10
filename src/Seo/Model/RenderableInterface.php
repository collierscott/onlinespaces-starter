<?php

namespace App\Seo\Model;

interface RenderableInterface
{
    /**
     * @return string
     */
    public function render();

    /**
     * @return string
     */
    public function __toString();
}