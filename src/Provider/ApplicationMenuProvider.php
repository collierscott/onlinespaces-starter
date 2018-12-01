<?php

namespace App\Provider;

use App\Repository\MenuRepository;
use Knp\Menu\FactoryInterface;
use Knp\Menu\NodeInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Knp\Menu\ItemInterface;

class ApplicationMenuProvider implements MenuProviderInterface
{
    private $factory;
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
     */
    public function get($name, array $options = array())
    {
        // TODO: Implement get() method.
    }

    /**
     * Checks whether a menu exists in this provider
     *
     * @param string $name
     * @param array $options
     *
     * @return boolean
     */
    public function has($name, array $options = array())
    {
        return $this->find($name, false) instanceof NodeInterface;
    }

    private function find($name, $throws)
    {

    }
}