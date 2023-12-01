<?php

namespace App\Controller;

use App\Entity\Travel; // ?
use App\Repository\TravelRepository; // ?
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TravelRepository $travelRepository): Response
    {

        return $this->render('home/home.html.twig', [
            'controller_name' => 'Home',
            'travels' => $travelRepository->findAll()
        ]);
    }

    #[Route('/create', name: 'travel_create')]
    public function create(): Response
    {
        return $this->render('home/create.html.twig');
    }

    #[Route('/edit/{id}', name: 'travel_edit')]
    public function edit($id): Response
    {
        return $this->render('home/edit.html.twig');
    }


    #[Route('/details/{{id}}', name: 'travel_details')]
    public function details($id): Response
    {
        return $this->render('home/details.html.twig', []);
    }
}
