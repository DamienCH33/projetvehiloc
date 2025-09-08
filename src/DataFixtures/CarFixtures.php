<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $carsData = [
            // Petites citadines
            ['Peugeot 208', 'Petite citadine pratique pour la ville', 4, 40.14],
            ['Renault Twingo', 'Mini citadine très maniable', 2, 35.50],
            ['Toyota Yaris', 'Compacte, fiable et peu énergivore', 4, 45.33],
            
            // Berlines classiques
            ['Volkswagen Golf', 'Berline polyvalente et confortable', 5, 80.25],
            ['BMW Série 1', 'Voiture premium compacte et confortable', 5, 90.75],
            ['Audi A3', 'Élégante et performante', 5, 85.49],
            
            // SUV / familiales
            ['Renault Captur', 'SUV urbain pratique et spacieux', 5, 70.19],
            ['Peugeot 2008', 'SUV compact avec un design moderne', 5, 75.64],
            ['BMW X1', 'SUV premium pour plus de confort', 7, 120.99],
            
            // Électriques
            ['Tesla Model 3', 'Voiture électrique moderne et rapide', 5, 120.88],
            ['Nissan Leaf', 'Électrique pratique pour les trajets quotidiens', 5, 95.60],
            
            // Citadines économiques
            ['Citroën C3', 'Citadine confortable et économique', 4, 40.45],
            ['Hyundai i20', 'Voiture fiable avec un bon rapport qualité/prix', 4, 43.77],
            ['Kia Rio', 'Compacte et économique pour la ville', 4, 41.32],
            
            // Voiture de luxe
            ['Mercedes Classe C', 'Berline premium avec équipements haut de gamme', 5, 150.50],
        ];

        foreach ($carsData as $data) {
            $car = new Car();
            $dailyPrice = $data[3];
            $monthlyPrice = round($dailyPrice * 25, 2);

            $car->setName($data[0])
                ->setDescription($data[1])
                ->setDailyPrice($dailyPrice)
                ->setMonthlyPrice($monthlyPrice)
                ->setPlaces($data[2])
                ->setManual($faker->boolean);

            $manager->persist($car);
        }

        $manager->flush();
    }
}

