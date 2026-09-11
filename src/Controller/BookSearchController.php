<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookSearchController extends AbstractController
{
    #[Route('/books', name: 'app_books')]
    public function index(Request $request, BookRepository $bookRepository): Response
    {
        $search = $request->query->get('q', '');

        if ($search) {
            $books = $bookRepository->search($search);
        } else {
            $books = $bookRepository->findAll();
        }

        return $this->render('book_search/index.html.twig', [
            'books' => $books,
            'search' => $search,
        ]);
    }
}
