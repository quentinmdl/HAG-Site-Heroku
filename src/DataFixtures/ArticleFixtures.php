<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Admin;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // for($i = 1; $i <= 3; $i++){
        //     $article = new Article();
        //     $article->setTitle("Titre Article n°$i")
        //             ->setDescription("BLALBLALVLDLVL")
        //             ->setImage("http://placehold.it/350x150")
        //             ->setAdmin(new Admin(getId()))
        //             ->setCreatedAt(new \DateTime());

        //     $manager->persist($article);
        // }
        // $manager->flush();
    }
}
