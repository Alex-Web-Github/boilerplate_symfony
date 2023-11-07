<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/sortie')]

class SortieController extends AbstractController
{
  #[Route('/', name: 'sortie_index')]
  public function index(SortieRepository $repo): Response
  {
    return $this->render('sortie/index.html.twig', [
      'sorties' => $repo->findAll(),
    ]);
  }
}
