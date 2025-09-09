<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findBy([], ['dailyPrice' => 'ASC'], 5);

        return $this->render('home.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/car/{id}', name: 'app_detail_car', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showDetailCar(int $id, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);

        if (!$car) {
            $this->addFlash('danger', "Cette voiture n'existe pas.");
            return $this->redirectToRoute('app_home');
        }
        return $this->render('carDetail.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route(path: '/car/{id}/delete', name: 'app_delete_car', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deleteCar(Request $request, int $id, CarRepository $carRepository, EntityManagerInterface $delete): Response
    {
        $car = $carRepository->find($id);

        if (!$car) {
            $this->addFlash('danger', "La voiture avec l'ID $id n'existe pas.");
            return $this->redirectToRoute('app_home');
        }
        $delete->remove($car);
        $delete->flush();

        $this->addFlash('success', "La voiture a bien été supprimée.");
        return $this->redirectToRoute('app_home');
    }

    #[Route(path: '/car/add', name: 'app_add_car', methods: ['GET', 'POST'])]
    public function addCar(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($car);
            $manager->flush();

            $this->addFlash('success', "La voiture a bien été ajoutée.");
            return $this->redirectToRoute('app_detail_car', ['id' => $car->getId()]);
        }

        return $this->render('newCar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
