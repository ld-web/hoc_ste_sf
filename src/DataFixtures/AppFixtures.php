<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        // On injecte le service d'encodage de mot de passe
        // Par constructeur
        $this->passwordEncoder = $passwordEncoder;
    }

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

        $user = new User();
        $user->setLogin('Bob');
        // On utilise le service injecté à la construction
        // Pour encoder notre mot de passe et l'affecter directement
        // à notre champ Password
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'bob1234'
        ));
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $manager->flush();
    }
}
