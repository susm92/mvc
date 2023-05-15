<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    #[Route('/library/create', name: 'get_book_create', methods: ['GET'])]
    public function getBookCreate(): Response
    {
        return $this->render('library/sites/createBook.html.twig');
    }

    #[Route('/library/create', name: 'post_book_create', methods: ['POST'])]
    public function postBookCreate(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = new Library();
        $book->setTitle();
        $book->setIsbn();
        $book->setAuthor();
        $book->setImage();

        $entityManager->persist($book);
        $entityManager->flush();

        return new Response('Saved new book to library');
    }

    #[Route('/library/show', name: 'library_show')]
    public function showLibrary(
        LibraryRepository $libraryRepository
    ): Response {
        $data = [
            'library' => $libraryRepository->findAll(),
        ];

        return $this->render('library/sites/showBooks.html.twig', $data);
    }
}
