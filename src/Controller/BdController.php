<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BdController extends AbstractController
{
    /**
     * @Route("/bd", name="bd")
     */
    public function index(): Response
    {
        return $this->render('bd/index.html.twig', [
            'controller_name' => 'BdController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */    
    public function home(): Response
    {
        return $this->render('bd/home.html.twig', [
            'title' => 'Bienvenue sur le site des BD !',
            'age' => 53
        ]);
    }
}
