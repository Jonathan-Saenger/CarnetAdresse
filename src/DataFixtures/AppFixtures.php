<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); // On instancie la Factory de Faker

        for($i=0; $i < 50; $i++) { // Tu vas boucler 50 fois 
            $contact = $this->createContact( // et à chaque fois tu vas me créer un nouveau contact
                $faker->lastName(), // avec les données suivantes
                $faker->firstName(),
                $faker->phoneNumber(),
            );

            $manager->persist($contact); // tu persistes les données
        }

        $manager->flush(); // tu flush les données
    }

    private function createContact (string $nom, string $prenom, string $telephone): Contact
    {
        $contact = new Contact;

        $contact
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setTelephone($telephone)
        ;

        return $contact;
    }
}
