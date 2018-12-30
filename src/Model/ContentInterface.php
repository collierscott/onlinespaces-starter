<?php

namespace App\Model;

interface ContentInterface
{
    public function getTitle(): ?string;
    public function setTitle(string $title): ContentInterface;
    public function getSlug(): ?string;
    public function setSlug(string $slug): ContentInterface;
}