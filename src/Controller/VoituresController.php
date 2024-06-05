<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\VoitureRepository;


class VoituresController extends AbstractController
{
    #[Route('/', name: 'app_voitures')]
    public function index(VoitureRepository $repository): Response
    {
        $cars = $repository->findAll();
        return $this->render('voitures/index.html.twig', [
            'controller_name' => 'VoituresController',
            'cars' => $cars,
        ]);
    }
}