<?php

namespace App\Controller;

use App\Entity\AnimalType;
use App\Form\AnimalTypeType;
use App\Repository\AnimalTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/animal/type')]
class AnimalTypeController extends AbstractController
{
    #[Route('/', name: 'app_animal_type_index', methods: ['GET'])]
    public function index(AnimalTypeRepository $animalTypeRepository): Response
    {
        return $this->render('animal_type/index.html.twig', [
            'animal_types' => $animalTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animal_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animalType = new AnimalType();
        $form = $this->createForm(AnimalTypeType::class, $animalType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animalType);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animal_type/new.html.twig', [
            'animal_type' => $animalType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_type_show', methods: ['GET'])]
    public function show(AnimalType $animalType): Response
    {
        return $this->render('animal_type/show.html.twig', [
            'animal_type' => $animalType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animal_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnimalType $animalType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalTypeType::class, $animalType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animal_type/edit.html.twig', [
            'animal_type' => $animalType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_type_delete', methods: ['POST'])]
    public function delete(Request $request, AnimalType $animalType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animalType->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animalType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animal_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
