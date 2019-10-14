<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {
            $contact = new Contact();
            $contact->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setObjet($faker->sentence(6, true))
                ->setMessage($faker->paragraph(7, true));

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
