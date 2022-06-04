<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create("ar_DZ");
        
        $users= [];
        $genres = ['male', 'female'];

        for ($i=0; $i <= 20 ; $i++) { 
            $user = new User();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1,99) . '.jpg';
            
            $picture .= ($genre == 'male' ? 'men/' : 'women/').$pictureId;

            $user->setFirstname($faker->firstname($genre))
                 ->setLastname($faker->lastname)
                 ->setEmail($faker->email)
                 ->setAvatar($picture)
                 ->setPresentation($faker->word(155))
                 ->setHash("password");
        
            $manager->persist($user);
            $users[] = $user;
      
        }

        for ($i=0; $i < 15 ; $i++) { 


            $author = $users[mt_rand(0, count($users) -1 )];

            $article = new Article();
            $article->setTitle($faker->word($faker->randomDigit()));
            $article->setIntro($faker->word($faker->randomDigit()));
            $article->setContent('<p>'. implode('</p><p>', $faker->words(80)) .'</p>');
            $article->setImage("https://picsum.photos/200/300?random=".$i);
            $article->setAuthor($author);
         
            $manager->persist($article);
        }


        $manager->flush();
    }
}

