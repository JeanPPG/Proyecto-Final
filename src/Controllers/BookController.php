<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Book;
use App\Repositories\BookRepository;
use App\Entities\Author;
use App\Repositories\AuthorRepository;

class BookController
{

    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function handle(): void
    {
        header('Content-Type: application/json');

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            if (isset($_GET['id'])) {
                $book = $this->bookRepository->findById((int)$_GET['id']);
                echo json_encode($book ? $this->bookToArray($book) : ['error' => 'Book not found']);
            } else {
                $list = array_map([$this, 'bookToArray'], $this->bookRepository->findAll());
                echo json_encode($list);
            }
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        if($method === 'POST'){
            $author = $this->authorRepository->findById((int)$payload['author_id']?? 0);
            if(!$author){
                http_response_code(400);
                echo json_encode(['error' => 'Author not found']);
                return;
            }
        }
    }

    public function bookToArray(Book $book): array
    {
        return [
            'publication_id' => $book->getId(),
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'publication_date' => $book->getPublicationDate()->format('Y-m-d'),
            'author' => [
                'id' => $book->getAuthor()->getId(),
                'first_name' => $book->getAuthor()->getFirstName(),
                'last_name' => $book->getAuthor()->getLastName()
            ],
            'isbn' => $book->getIsbn(),
            'genre' => $book->getGenre(),
            'edition' => $book->getEdition()
        ];
    }
}
