<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findBy([], ['daily_price' => 'ASC'],5);

        return $this->render('home.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/car/{id}', name: 'app_detail_car', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showDetailCar(int $id, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException("Cette voiture n'existe pas.");
        }
        return $this->render('carDetail.html.twig', [
            'car' => $car,
        ]);
    }
}
