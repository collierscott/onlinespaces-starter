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
        $item->setName('home');
        $item->setMenu($menu);
        $item->setLabel('Home');
        $item->setLink('home_page');
        $item->setIcon('fal fa-home');
        $item->setSortOrder(1);
        $manager->persist($item);

        $item = new MenuItem();
        $item->setName('articles');
        $item->setMenu($menu);
        $item->setLabel('Articles');
        $item->setLink('article_list');
        $item->setIcon('fal fa-file');
        $item->setSortOrder(2);
        $manager->persist($item);

        $manager->flush();
    }
}
