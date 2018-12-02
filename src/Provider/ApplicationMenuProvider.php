<?php

namespace App\Provider;

use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Exception\MenuNotFoundException;
use App\Repository\MenuRepository;
use Knp\Menu\FactoryInterface;
use Knp\Menu\NodeInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Knp\Menu\ItemInterface;

class ApplicationMenuProvider implements MenuProviderInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /** @var MenuRepository $repository */
    private $repository;

    public function __construct(FactoryInterface $factory, MenuRepository $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    /**
     * Retrieves a menu by its name
     *
     * @param string $name
     * @param array $options
     *
     * @return ItemInterface
     * @throws \InvalidArgumentException if the menu does not exists
     * @throws MenuNotFoundException
     */
    public function get($name, array $options = array())
    {
        $root = $this->find($name, true);

        $menu = $this->factory->createItem('root');

        /** @var MenuItem $item */
        foreach ($root->getChildren() as $item) {
            $menu->addChild($item->getLabel(), ['route' => $item->getLink()]);
            // TODO Need to get all children and children of children if displaying children
            // TODO Should probably be able to set max depth also
        }

        return $menu;
    }

    /**
     * Checks whether a menu exists in this provider
     *
     * @param string $name
     * @param array $options
     *
     * @return boolean
     * @throws MenuNotFoundException
     */
    public function has($name, array $options = array())
    {
        return $this->find($name, false) instanceof NodeInterface;
    }

    /**
     * @param $name
     * @param $throw
     * @return Menu|bool|null
     * @throws MenuNotFoundException
     */
    private function find($name, $throw)
    {
        if (!$name) {
            if ($throw) {
                throw new \InvalidArgumentException('The menu name may not be empty');
            }
            return false;
        }

        $menu = $this->repository->findOneBy(['name' => $name]);

        if(null === $menu) {
            if($throw) {
                throw new MenuNotFoundException(sprintf('The menu with the name %s was not found.', $name));
            }
        }
        //dd($menu);
        return $menu;
    }
}