<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Travel;
use App\Form\TravelType;



class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(ManagerRegistry $doctrine): Response
    {
        $travels = $doctrine->getRepository(Travel::class)->findAll();


        return $this->render('home/home.html.twig', [
            'controller_name' => 'Home',
            'travels' => $travels,
        ]);
    }

    #[Route('/create', name: 'travel_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travel = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($travel);
            $em->flush();

            $this->addFlash(
                'notice',
                'Travel destination has been added'
            );
            return $this->redirectToRoute('home');
        }

        return $this->render('home/create.html.twig', [
            'form' => $form->createView()
        ]);
    }



    #[Route('/edit/{id}', name: 'travel_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $travel = $doctrine->getRepository(Travel::class)->find($id);
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travel = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($travel);
            $em->flush();

            $this->addFlash(
                'notice',
                'Travel destination has been edited'
            );
            return $this->redirectToRoute('home');
        }

        return $this->render('home/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }



    #[Route('/details/{id}', name: 'travel_details')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $travel = $doctrine->getRepository(Travel::class)->find($id);
        return $this->render('home/details.html.twig', [
            'controller_name' => 'Details',
            'travel' => $travel,
        ]);
    }


    #[Route('/delete/{id}', name: 'travel_delete')]
    public function delete($id)
    {

        $em = $this->getDoctrine()->getManager();

        $travel = $em->getRepository('App:Travel')->find($id);
        $em->remove($travel);

        $em->flush();
        $this->addFlash(
            'notice',
            'Destination Removed'
        );

        return $this->redirectToRoute('home');
    }
}
