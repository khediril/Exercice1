<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categs=[];
        for ($i=0; $i <20 ; $i++) { 
            $c = new Categorie();
            $c->setName("Categorie ".$i);
            
            $manager->persist($c);
            $categs[] = $c;
        }
        $fours = [];
        for ($i=0; $i <50 ; $i++) { 
            $f = new Fournisseur();
            $f->setTel(random_int(1000000,9000000));
            $f->setName($faker->name());
            $f->setAdresse($faker->address());
            $manager->persist($f);
            $fours[]=$f;
        }

        for ($i=0; $i <100 ; $i++) { 
            $p = new Produit();
            $p->setName("Produit ".$i);
            $p->setPrice(random_int(100,10000));
            $p->setDescription("description ".$i);
            $c = $categs[random_int(0,19)];
            $p->setCategorie($c);
            $p->addFournisseur($fours[random_int(0,49)]);
            $manager->persist($p);
        }
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
