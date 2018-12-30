<?php
/**
 * Created by PhpStorm.
 * User: scoll
 * Date: 12/8/2018
 * Time: 8:57 AM
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'child_categories', function() {
            $category = new Category();
            $category->setTitle($this->faker->word);

            return $category;
        });

        $this->createMany(10, 'main_categories', function() {
            $category = new Category();
            $category->setTitle($this->faker->word);
            $children = $this->getRandomReferences('child_categories', $this->faker->numberBetween(0, 10));
            foreach ($children as $child) {
                $category->addChild($child);
            }
            return $category;
        });

        $manager->flush();
    }
}