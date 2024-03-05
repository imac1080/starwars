<?php

namespace App\Controller;

use App\Entity\Charecters;
use App\Form\CharectersFormType;
use App\Repository\CharectersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CharectersController extends AbstractController
{
    private $em;
    private $CharectersRepository;
    public function __construct(
        EntityManagerInterface $em, 
        CharectersRepository $CharectersRepository) 
    {
        $this->em = $em;
        $this->CharectersRepository = $CharectersRepository;
    }

    #[Route('/charecters', name: 'charecters')]
    public function index(): Response
    {
        $charecters = $this->CharectersRepository->findAll();

        return $this->render('charecters/index.html.twig', [
            'charecters' => $charecters
        ]);
    }

    #[Route('/charecters/create', name: 'create_charecters')]
    public function create(Request $request): Response
    {
        $charecters = new Charecters();
        $form = $this->createForm(CharectersFormType::class, $charecters);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newcharecters = $form->getData();
            $imagePath = $form->get('picture')->getData();
            
            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newcharecters->setPicture('uploads/' . $newFileName);
            }

            $this->em->persist($newcharecters);
            $this->em->flush();

            return $this->redirectToRoute('charecters');
        }

        return $this->render('charecters/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/charecters/edit/{id}', name: 'charecters_movie')]
    public function edit($id, Request $request): Response 
    {
        $Charecters = $this->CharectersRepository->find($id);
        $form = $this->createForm(CharectersFormType::class, $Charecters);

        $form->handleRequest($request);
        $Picture = $form->get('picture')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($Picture) {
                if ($Charecters->getPicture() !== null) {
                    if (file_exists(
                        $this->getParameter('kernel.project_dir') . $Charecters->getPicture()
                        )) {
                            $this->GetParameter('kernel.project_dir') . $Charecters->getPicture();
                    }
                    $newFileName = uniqid() . '.' . $Picture->guessExtension();

                    try {
                        $Picture->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $Charecters->setPicture('uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('charecters');
                }
            } else {
                $Charecters->setName($form->get('name')->getData());
                $Charecters->setMass($form->get('mass')->getData());
                $Charecters->setHeight($form->get('height')->getData());
                $Charecters->setGender($form->get('gender')->getData());

                $this->em->flush();
                return $this->redirectToRoute('charecters');
            }
        }

        return $this->render('charecters/edit.html.twig', [
            'Charecters' => $Charecters,
            'form' => $form->createView()
        ]);
    }

    // #[Route('/movies/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_movie')]
    // public function delete($id): Response
    // {
    //     $movie = $this->CharectersRepository->find($id);
    //     $this->em->remove($movie);
    //     $this->em->flush();

    //     return $this->redirectToRoute('movies');
    // }

    // #[Route('/movies/{id}', methods: ['GET'], name: 'show_movie')]
    // public function show($id): Response
    // {
    //     $movie = $this->CharectersRepository->find($id);
        
    //     return $this->render('movies/show.html.twig', [
    //         'movie' => $movie
    //     ]);
    // }

}
