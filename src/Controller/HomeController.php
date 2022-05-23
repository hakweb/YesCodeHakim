<?php

namespace App\Controller;


use App\Entity\Fruit;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'home_page')]
    public function index(){

        $banane = new Fruit();

        $banane->setName("Jack");

        dump( $banane);
        return $this->render('home/index.html.twig', [ 'jack' => $banane]);
    }


}

