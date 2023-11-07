<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/marque')]

class MarqueController extends AbstractController
{

  // Create Read(All ou 1 en particulier) Update Delete
  #[Route('/', name: 'marque_index', methods: ['GET'])]
  public function index(MarqueRepository $repo): Response
  {
    //dd(__METHOD__); // means Dump & Die

    return $this->render('marque/index.html.twig', [
      'marques' => $repo->findAll(),
    ]);
  }

  #[Route('/{id}', name: 'marque_show', requirements: ['id' => '\d+'], methods: ['GET'])]
  public function show(Marque $marque): Response
  {

    return $this->render('marque/show.html.twig', [
      'marque' => $marque,
    ]);
  }

  #[Route('/marque/create', name: 'marque_create', priority: 0, methods: ['GET', 'POST'])]
  public function create(Request $request, MarqueRepository $repo): Response
  {

    $marque = new Marque();

    $form = $this->createForm(MarqueType::class, $marque);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $repo->save($marque, true);
      // Ici insérer un message pour confirmer la bonne création de la Marque
      return $this->redirectToRoute('marque_index');
    }

    return $this->render('marque/create.html.twig', [
      'formView' => $form->createView(),
    ]);
  }


  // public function create(Request $request, EntityManagerInterface $entityManager): Response
  // {
  //   // dd(__METHOD__); // Dump & Die
  //   $marque = new Marque();

  //   $form = $this->createForm(MarqueType::class, $marque);
  //   // gestion des données transmises ($request) par le formulaire
  //   $form->handleRequest($request);

  //   if ($form->isSubmitted() && $form->isValid()) {
  //     $entityManager->persist($marque);
  //     $entityManager->flush();
  //     return $this->redirectToRoute('marque_index');
  //   }

  //   // Affichage de la Vue du Formulaire d'Ajout
  //   return $this->render('marque/create.html.twig', [
  //     'formView' => $form->createView(),
  //   ]);
  // }

  #[Route('/{id}/edit', name: 'marque_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
  public function update(Marque $marque, Request $request, MarqueRepository $repo): Response
  {
    // dd(__METHOD__); // Dump & Die
    $form = $this->createForm(MarqueType::class, $marque);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $repo->save($marque, true);

      return $this->redirectToRoute('marque_index');
    }

    // Affichage de la Vue du Formulaire d'Ajout
    return $this->render('marque/edit.html.twig', [
      'formView' => $form->createView(),
    ]);
  }

  #[Route('/{id}/delete', name: 'marque_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
  public function delete(Marque $marque, MarqueRepository $repo): Response
  {
    $repo->remove($marque, true);
    return $this->redirectToRoute('marque_index');
  }
}
