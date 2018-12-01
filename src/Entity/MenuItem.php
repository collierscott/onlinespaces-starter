<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\Menu\NodeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuItemRepository")
 * @ORM\Table(name="menu_items")
 */
class MenuItem implements NodeInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="children")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $linkType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $displayChildren;

    /**
     * @ORM\Column(type="integer")
     */
    private $sortOrder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHome;

    /**
     * Many MenuItems have One MenuItem.
     * @ORM\ManyToOne(targetEntity="App\Entity\MenuItem", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * One MenuItem has Many MenuItems.
     * @ORM\OneToMany(targetEntity="App\Entity\MenuItem", mappedBy="parent")
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->isPublished = true;
        $this->isHome = false;
        $this->sortOrder = 0;
        $this->linkType = 'route';
        $this->displayChildren = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get the name of the node
     *
     * Each child of a node must have a unique name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getLinkType(): ?string
    {
        return $this->linkType;
    }

    public function setLinkType(string $linkType): self
    {
        $this->linkType = $linkType;

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
     * @return bool
     */
    public function isDisplayChildren(): bool
    {
        return $this->getIsDisplayedChildren();
    }

    public function getIsDisplayedChildren(): ?bool
    {
        return $this->displayChildren;
    }

    /**
     * @param bool $displayChildren
     */
    public function setDisplayChildren(bool $displayChildren): void
    {
        $this->displayChildren = $displayChildren;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getIsHome(): ?bool
    {
        return $this->isHome;
    }

    public function setIsHome(bool $isHome): self
    {
        $this->isHome = $isHome;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
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
            'link-type' => $this->getLinkType(),
            'published' => $this->getIsPublished(),
            'name' => $this->getName(),
            'home' => $this->getIsHome(),
            'alias' => $this->getAlias(),
            'sort-order' => $this->getSortOrder(),
            'display-children' => $this->getIsDisplayedChildren(),
        ];
    }
}
