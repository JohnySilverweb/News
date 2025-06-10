<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Novice;
use App\Form\NoviceType;
use App\Form\SearchType;
use App\Repository\NoviceRepository;
use App\Service\FileUploader;

class NoviceController extends AbstractController
 {
    #[Route('/novice/index', name: 'novice_index')] 
    public function index(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $novice = new Novice();
        $form = $this->createForm(NoviceType::class, $novice);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $novice->setImage($imageFileName);
            }

            $em->persist($novice);
            $em->flush();
            return $this->redirectToRoute('novice_table');
        }
        return $this->render('novice/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/novice/table', name: 'novice_table')]
    public function showtable(NoviceRepository $noviceRepository): Response
    {
        return $this->render('novice/table.html.twig', [
            'novice' => $noviceRepository->findAll(),
        ]);
    }

    #[Route('/novice/cards', name: 'novice_cards')]
    public function showcards(NoviceRepository $noviceRepository): Response
    {
        $novice = $noviceRepository->seePublished();

        return $this->render('novice/cards.html.twig', [
            'novice' => $novice,
        ]);
    }

    #[Route('/', name: 'novice_search')]
    public function search(Request $request, NoviceRepository $noviceRepository): Response
    {
        $form = $this->createForm(SearchType::class, null, ['method' => 'GET', 'csrf_protection' => false]);
        $form->handleRequest($request);

        $tasks = [];
        $searchQuery = '';

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchQuery = $data['search'] ?? '';
            $tasks = $noviceRepository->searchNews($searchQuery);

        }

        return $this->render('/novice/search.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks,
            'searchQuery' => $searchQuery,
        ]);
    }

    #[Route('/novice/edit/{id}', name: 'novice_edit')]
    public function edit(Request $request, Novice $novice, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(NoviceType::class, $novice);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $novice->setImage($imageFileName);
            }

            $novice->setUpdatedAt(new \DateTime());
            $em->persist($novice);
            $em->flush();

            return $this->redirectToRoute('novice_table');
        }
        return $this->render('novice/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/novice/delete/{id}', name: 'novice_delete')]
    public function delete(Novice $novice, EntityManagerInterface $em): Response
    {
        $em->remove($novice);
        $em->flush();
        return $this->redirectToRoute('novice_table');
    }

    #[Route('/novice/duplicate/{id}', name: 'novice_duplicate')]
    public function duplicate(int $id, NoviceRepository $noviceRepository): Response
    {
        $noviceRepository->duplicateNews($id);
        return $this->redirectToRoute('novice_table');
    }

    #[Route('/novice/{id}', name: 'novice_id')]
    public function move(Novice $novice): Response
    {        
        return $this->render('novice/moreinfo.html.twig', [
            'novice' => $novice,
        ]);
    }

} 