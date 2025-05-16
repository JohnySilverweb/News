<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\NoviceController;
use App\Entity\Novice;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\NoviceType;
use App\Repository\NoviceRepository;
use App\Form\SearchType;


final class NoviceController extends AbstractController
 {
    #[Route('/novice/index', name: 'novice_index')] 
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $novice = new Novice();
        $form = $this->createForm(NoviceType::class, $novice);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($novice);
            $em->flush();
            return $this->redirectToRoute('novice_data');
        }
        return $this->render('novice/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/novice/data', name: 'novice_data')]
    public function showdata(NoviceRepository $noviceRepository): Response
    {
        $tasks = $noviceRepository->findAll();

        return $this->render('novice/data.html.twig', [
            'novice' => $noviceRepository->findAll(),
        ]);
    }

    #[Route('/novice/delete', name: 'novice_delete')]
    public function delete(NoviceRepository $noviceRepository, EntityManagerInterface $em): Response
    {
        $tasks = $noviceRepository->findAll();
        $tenMinutes = new \DateTime('-10 minutes');
        foreach($tasks as $novice) {
            if($novice->getCreatedAt() <= $tenMinutes) {
                $em->remove($novice);
            }
        }
        $em->flush();

        return $this->redirectToRoute('novice_data');
    }

    #[Route('/novice/search', 'novice_search')]
    public function search(Request $request, NoviceRepository $noviceRepository): Response
    {
        $form = $this->createForm(SearchType::class, null, ['method' => 'GET', 'csrf_protection' => false]);
        $form->handleRequest($request);

        $tasks = [];

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchQuery = $data['search'] ?? '';
            $tasks = $noviceRepository->searchNews($searchQuery);
        }

        return $this->render('/novice/search.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks,
        ]);
    }
 }