<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\Menu\NodeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 * @ORM\Table(name="menus")
 */
class Menu implements NodeInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $menuType;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuItem", mappedBy="menu")
     */
    private $children;

    public function __construct()
    {
        $this->menuType = 'user';
        $this->isPublished = true;
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuType(): ?string
    {
        return $this->menuType;
    }

    public function setMenuType(string $menuType): self
    {
        $this->menuType = $menuType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get the child nodes implementing NodeInterface
     *
     * @return \Traversable
     */
    public function getChildren(): \Traversable
    {
        return $this->children;
    }

    public function addChild(MenuItem $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setMenu($this);
        }

        return $this;
    }

    public function removeChild(MenuItem $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getMenu() === $this) {
                $child->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * Get the options for the factory to create the item for this node
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            'menu-type' => $this->getMenuType(),
            'published' => $this->getIsPublished(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }
}
