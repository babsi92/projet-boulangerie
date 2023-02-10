<?php

namespace App\Controller;

use App\Entity\Paniers;
use App\Repository\ProduitsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaniersController extends AbstractController
{
    /**
     * @Route("/panier", name="app_user_panier")
     */
    public function index(UsersRepository $usersRepository) 
    {
        $user = $usersRepository->findOneBy(['email' =>  $this->getUser()->getUserIdentifier()]); 
        $panier = $user->getPanier();

        return $this->render('paniers/index.html.twig', [
            'produits' =>  $panier->getArticle()
        ]);

    }   

     /**
     * @Route("/paniers/{id_produit}", name="add_produit_to_panier")
     */
   
    public function addProduitToPanier($id_produit, UsersRepository $usersRepository, ProduitsRepository $produitsRepository, EntityManagerInterface $entityManager)
    { 
        $user = $usersRepository->findOneBy(['email' =>  $this->getUser()->getUserIdentifier()]); 
        $produit = $produitsRepository->find($id_produit);
        $panier = $user->getPanier();
        if($panier == null) {
            $panier = new Paniers();
        }
        $panier->setEmail($user->getEmail());
        $produit->setPaniers($panier);
        $user->setPanier($panier);
        // $panier->setUsers($user);
        $entityManager->persist($panier);
        $entityManager->persist($produit);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirect('/panier');

    }    
    
}
