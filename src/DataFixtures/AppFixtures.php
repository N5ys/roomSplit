<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $libelles = ["facture", "ménage", "soirée", "contrats"];
        $types = ["expense", "task", "event", "document"];

        // Tableau pour stocker les catégories
        $categories = [];

        for ($i = 0; $i < count($libelles); $i++) {
            $category = new Category();
            $category->setLibelle($libelles[$i]);
            $category->setTypeCategory($types[$i]);
            $category->setDescription("");
            $category->setDateCreation(new \DateTime());
            $manager->persist($category);

            // Ajouter la catégorie au tableau
            $categories[] = $category;
        }

        // Persist toutes les entités catégories
        $manager->flush();

        // Création d'événements en utilisant les catégories créées
        for ($i = 0; $i < 10; $i++) {
            $event = new Event();
            $event->setTitle('Event ' . ($i + 1));
            $event->setDescription('Description for event ' . ($i + 1));
            $event->setDateEvent(new \DateTime());
            $event->setDateCreation(new \DateTime());

            // Assigner une catégorie aléatoire à l'événement
            $randomCategory = $categories[array_rand($categories)];
            $event->setCategory($randomCategory);

            $manager->persist($event);
        }

        // Persist toutes les entités événements
        $manager->flush();
    }
}

