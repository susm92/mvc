<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class APILibraryController extends AbstractController
{
    #[Route('/api/library/books', name: 'get_api_library', methods: ['GET'])]
    public function getAPILibrary(
        LibraryRepository $libraryRepository
    ): response {
        $books = $libraryRepository->findAll();

        return $this->json($books);
    }

    #[Route('/api/library/book/{isbn}', name: 'get_api_isbn_book', methods: ['GET'])]
    public function getAPIBookISBN(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $isbn = $request->get('isbn');
        $isbn = intval($isbn);

        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('l')
            ->from('App\Entity\Library', 'l')
            ->where('l.isbn = :isbn')
            ->setParameter('isbn', $isbn);

        $query = $queryBuilder->getQuery();
        $book = $query->getResult();

        return $this->json($book);
    }
}
