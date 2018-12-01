<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\MenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $menu = new Menu();
        $menu->setDescription("Main Menu");
        $menu->setName('main-menu');
        $menu->setMenuType('main');
        $manager->persist($menu);

        $item = new MenuItem();
        $item->setName('child-one');
        $item->setMenu($menu);
        $item->setAlias('child-one');
        $item->setLink('home_page');
        $manager->persist($item);

        $manager->flush();
    }
}
