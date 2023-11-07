<?php

namespace App\Controller;

use App\Repository\AdhesionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/adhesion')]

class AdhesionController extends AbstractController
{
  #[Route('/', name: 'adhesion_index')]
  public function index(AdhesionRepository $repo): Response
  {
    return $this->render('adhesion/index.html.twig', [
      'adhesions' => $repo->findAll(),
    ]);
  }
}
