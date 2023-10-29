<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MarqueController extends AbstractController
{

  // Create Read(All ou 1 en particulier) Update Delete


  #[Route('/marque', name: 'marque_index', methods: ['GET'])]
  public function index(MarqueRepository $repo): Response
  {
    //dd(__METHOD__); // means Dump & Die

    return $this->render('marque/index.html.twig', [
      'marques' => $repo->findAll(),
    ]);
  }

  #[Route('/marque/{id}', name: 'marque_show', requirements: ['id' => '\d+'], methods: ['GET'])]
  public function show(Marque $marque): Response
  {
    //dd(__METHOD__); // Dump & Die
    //dd($request->attributes->get('id'));
    // dd($repo->find($request->attributes->get('id')));
    // dd($repo->find($id));
    // dd($id);
    // dd($marque);

    return $this->render('marque/show.html.twig', [
      'marque' => $marque,
    ]);
  }

  #[Route('/marque/create', name: 'marque_create', methods: ['GET', 'POST'])]
  public function create(): Response
  {
    dd(__METHOD__); // Dump & Die


  }

  #[Route('/marque/{id}/edit', name: 'marque_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
  public function update(): Response
  {
    dd(__METHOD__); // Dump & Die

  }

  #[Route('/marque/{id}/delete', name: 'marque_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
  public function delete(): Response
  {
    dd(__METHOD__); // Dump & Die

  }
}
