<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits")
 */

class ProduitsController extends AbstractController
{

    /**
     * @var ProduitsRepository
     */
    private $produitsRepository;

    public  function __construct(ProduitsRepository $produitsRepository)
    {
        $this->produitsRepository = $produitsRepository;
    }

    /**
     * @Route("/", name="app_produits_index", methods={"GET"})
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_produits_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_produits_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }


     /**
     * @Route("/new", name="app_produits_new", methods={"GET", "POST"})
     */
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $produit = new Produits();

        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();

            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        #ETAPE 4 : générer le formulaire dans la vue
        return $this->render('produits/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/delete", name="app_produits_delete", methods={"POST"})
     */
    public function delete(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->request->get('_token'))) {
            $produitsRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }
}
