<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CarType;
use App\Entity\Car;
use Symfony\Component\HttpFoundation\Request;


class CarController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $repository): Response
    {
        $cars = $repository->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
        ]);
    }
    #[Route('/car/{id}', name: 'app_car')]
    public function car(int $id, CarRepository $repository): Response
    {
        $car = $repository->find($id);
        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        return $this->render('car/car.html.twig', [
            'car' => $car,
        ]);
    }
    #[Route('/car/{id}/remove', name: 'app_car_remove')]
    public function remove(int $id, CarRepository $repository,  EntityManagerInterface $entityManagerInterface): Response
    {
        $car = $repository->find($id);
        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        $entityManagerInterface->remove($car);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('app_home');
    }

    #[Route('/add', name: 'app_car_form')]
    public function addCar(Request $request, EntityManagerInterface $entityManager): Response
{
    $car = new Car();

    $form = $this->createForm(CarType::class, $car);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $car = $form->getData();
        $entityManager->persist($car);
        $entityManager->flush();

        return $this->redirectToRoute('app_car', ['id' => $car->getId()]);
    }

    return $this->render('car/form.html.twig', [
        'form' => $form,
    ]);
}

}
