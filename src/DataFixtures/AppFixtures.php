<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            $contact = new Contact();
            $contact->setNom("Curie")
                ->setPrenom("Marie")
                ->setEmail("marie@curie.com")
                ->setObjet("Ma demande numéro $i")
                ->setMessage("Mon message numéro $i");

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
