<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->realText(200));

            $manager->persist($category);
            
            for ($a = 1; $a <= mt_rand(4, 6); $a++) {
                $article = new Article();

                // $description = '<p>' . join($faker->paragraphs(4),'</p><p>') . '</p>';

                $article->setTitle($faker->sentence())
                        ->setDescription($faker->realText(200))
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);

                $manager->persist($article);
            }

            for ($c = 1; $c <= mt_rand(2, 5); $c++) {
                $comment = new Comment();

                // $content = '<p>' . join($faker->paragraphs(4),'</p><p>') . '</p>';

                $days = (new \DateTime())->diff($article->getCreatedAt())->days;
                
                $comment->setAuthor($faker->name)
                        ->setContent($faker->realText(200))
                        ->setCreatedAt($faker->dateTimeBetween('-' . $days . 'days'))
                        ->setArticle($article);

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
