<?php

namespace App\Model;

interface NodeTypeInterface
{
    public function getTitle(): ?string;
    public function setTitle(string $title): NodeTypeInterface;
    public function getSlug(): ?string;
    public function setSlug(string $slug): NodeTypeInterface;
}