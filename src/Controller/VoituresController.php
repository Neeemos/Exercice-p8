<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use App\Entity\Voiture;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/add', name: 'app_car_form')]
    public function addCar(Request $request, EntityManagerInterface $entityManager): Response
{
    $voiture = new Voiture();

    $form = $this->createForm(VoitureType::class, $voiture);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $voiture = $form->getData();
        $entityManager->persist($voiture);
        $entityManager->flush();

        return $this->redirectToRoute('app_car', ['id' => $voiture->getId()]);
    }

    return $this->render('voitures/form.html.twig', [
        'form' => $form,
    ]);
}

}
