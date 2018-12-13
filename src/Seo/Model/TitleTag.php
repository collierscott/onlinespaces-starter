<?php

namespace App\Seo\Model;

class TitleTag implements RenderableInterface
{
    /**
     * @var string
     */
    protected $content;
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }
    /**
     * @return string
     */
    public function render()
    {
        return sprintf('<title>%s</title>', $this->getContent());
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}