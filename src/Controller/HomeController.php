<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/maison", name="maison")
     */
    public function maison(): Response
    {
        return $this->render('home/maison.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



    /**
     * @Route("/produits/categories", name="categories_show")
     */
    public function categories(): Response
    {
        return $this->render('home/categories.html.twig');
    }

    /**
     * @Route("/produits/categories/{type}", name="categories_produits_show")
     */
    public function produits($type, ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findByType($type);
        return $this->render('home/produits.html.twig', [
            'produits' => $produits,
        ]);
    }
}
