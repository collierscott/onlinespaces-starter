<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $articleImages = [
        'build\images\default_article_image.png',
        'build\images\default_image.jpg',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_articles', function($count) use ($manager) {
            $paragraphs = $this->faker->paragraphs(4,false);
            $content = "<p>" . implode("</p><p>", $paragraphs) . "</p>";
            $summary = implode(" ", $paragraphs);
            $article = new Article();
            $article->setTitle($this->faker->sentence(4, true));
            $article->setContent($content);
            $article->setSummary(substr(implode("", $paragraphs), 0, 150));

            // publish most articles
            if ($this->faker->boolean(70)) {
                $article->setPublishedStartAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
            $article->setIsPublished($this->faker->boolean(70));

            $article->setAuthor($this->getRandomReference('main_users'));
            $article->setCoverImage($this->faker->randomElement(self::$articleImages));
            $article->setCategory($this->getRandomReference('child_categories'));

            return $article;
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}