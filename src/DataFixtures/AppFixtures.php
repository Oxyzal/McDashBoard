<?php

namespace App\DataFixtures;

use App\Entity\District;
use App\Entity\Product;
use App\Entity\ProductRestaurant;
use App\Entity\Restaurant;
use App\Repository\ProductRepository;
use App\Repository\ProductRestaurantRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $l_product = ['Big Mac', 'Potatoes', 'McFlurry', 'Wrap', 'Nuggets', 'CheeseBurger', 'Salad', 'McFirst', 'Chips', 'Signature'];

        foreach ($l_product as $item) {
            $product = new Product();
            $product->setName($item)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdateAt(new \DateTimeImmutable());
            $manager->persist($product);
        }


        $l_district = ['Bezons', 'MonCucq', 'Paris', 'Saint-Ouen', 'Anger', 'Nanterre', 'Argenteuil', 'Nime', 'Montpellier', 'Rohdigan', 'Marseille', 'Nice', 'Rueil-Malmaison', 'Tokyo', 'Kyoto', 'Osaka', 'Hiroshima', 'Nagoya', 'Dunkerque', 'Oslo'];
        foreach ($l_district as $list_district) {
            $district = new District();
            $district->setName($list_district)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdateAt(new \DateTimeImmutable())
                ->setPopulation(random_int(1000, 100000));
            $manager->persist($district);


            for ($i = 0; $i < 9; $i++) {
                $restaurant = new Restaurant();
                $restaurant->setName('Mcdonal' . $district->getName() . $i)
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setUpdatedAt(new \DateTimeImmutable())
                    ->setDistrict($district);
                $manager->persist($restaurant);

            }
            $manager->flush();


            $AllItem = ($manager->getRepository(Product::class))->findAll();

            for ($j = 0; $j < 10; $j++) {
                $ProductRestaurant = new ProductRestaurant();
                $ProductRestaurant->setPrice(rand(1, 15))
                    ->setStock(random_int(1, 1000))
                    ->setRestaurant($restaurant)
                    ->setProduct($AllItem[$j]);
                $manager->persist($ProductRestaurant);
            }
        }

            $manager->flush();

    }
}
