<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Admin;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setEmail("admin@admin.com")
            ->setPassword("password");

            $manager->persist($admin);
        $manager->flush();
    }
}
