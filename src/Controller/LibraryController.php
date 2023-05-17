<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $imgUrl = $request->request->get('img_url');

        $entityManager = $doctrine->getManager();

        $book = new Library();
        $book->setTitle($title);
        $book->setIsbn(intVal($isbn));
        $book->setAuthor($author);
        $book->setImage($imgUrl);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show');
    }

    #[Route('/library/show', name: 'library_show')]
    public function showLibrary(
        LibraryRepository $libraryRepository,
        EntityManagerInterface $entityManager
    ): Response {

        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('l.id', 'l.title', 'l.isbn', 'l.author', 'l.image')
            ->from('App\Entity\Library', 'l');
        $query = $queryBuilder->getQuery();
        $library = $query->getResult();

        $data = [
            'library' => $library,
        ];

        return $this->render('library/sites/showBooks.html.twig', $data);
    }

    #[Route('/library/edit/{id}', name: 'name_by_id', methods: ["GET"])]
    public function editBookById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {

        $data = [
            'book' =>  $libraryRepository->find($id),
        ];

        return $this->render('library/sites/editBook.html.twig', $data);
    }

    #[Route('/library/edit/{id}', name: 'post_book_update', methods:["POST"])]
    public function updateBookById(
        LibraryRepository $libraryRepository,
        int $id,
        Request $request
    ): Response {

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $imgUrl = $request->request->get('img_url');

        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for title '.$title
            );
        }

        $book->setTitle($title);
        $book->setIsbn(intVal($isbn));
        $book->setAuthor($author);
        $book->setImage($imgUrl);
        $libraryRepository->save($book, true);

        return $this->redirectToRoute('library_show');
    }

    #[Route('/library/delete/{id}', name: 'delete_by_id', methods: ["GET"])]
    public function deleteBookById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {

        $data = [
            'book' =>  $libraryRepository->find($id),
        ];

        return $this->render('library/sites/deleteBook.html.twig', $data);
    }

    #[Route('/library/delete/{id}', name: 'post_delete_book', methods:["POST"])]
    public function postDeleteBookById(
        LibraryRepository $libraryRepository,
        int $id,
    ): Response {

        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for title '.$book
            );
        }

        $libraryRepository->remove($book, true);

        return $this->redirectToRoute('library_show');
    }
}
