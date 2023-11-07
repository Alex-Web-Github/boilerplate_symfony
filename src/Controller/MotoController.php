<?php

namespace App\Controller;

use App\Repository\MotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/moto')]

class MotoController extends AbstractController
{
  #[Route('/', name: 'moto_index')]
  public function index(MotoRepository $repo): Response
  {
    return $this->render('moto/index.html.twig', [
      'moto' => $repo->findAll(),
    ]);
  }
}
