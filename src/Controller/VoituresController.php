<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;


class VoituresController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VoitureRepository $repository): Response
    {
        $cars = $repository->findAll();
        return $this->render('voitures/index.html.twig', [
            'controller_name' => 'VoituresController',
            'cars' => $cars,
        ]);
    }
    #[Route('/car/{id}', name: 'app_car')]
    public function car(int $id, VoitureRepository $repository): Response
    {
        $car = $repository->find($id);
        if (!$car) {
            return $this->redirect('/');
        }
        return $this->render('voitures/car.html.twig', [
            'controller_name' => 'VoituresController',
            'car' => $car,
        ]);
    }
    #[Route('/car/{id}/remove', name: 'app_car_remove')]
    public function remove(int $id, VoitureRepository $repository,  EntityManagerInterface $entityManagerInterface): Response
    {
        $car = $repository->find($id);
        if (!$car) {
            return $this->redirect('/');
        }
        $entityManagerInterface->remove($car);
        $entityManagerInterface->flush();
        return $this->redirect('/');
    }
}
