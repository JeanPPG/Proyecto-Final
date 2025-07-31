<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Config\Database;
use App\Entities\Author;
use App\Entities\Book;
use PDO;

class BookRepository implements RepositoryInterface
{
    private PDO $db;

    private AuthorRepository $authorRepository;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->authorRepository = new AuthorRepository();
    }

    private function hydrate(array $row): Book
    {
        $author = new Author(
            (int)$row['id'],
            $row['first_name'],
            $row['last_name'],
            $row['username'],
            $row['email'],
            'temporal', 
            $row['orcid'],
            $row['affiliation']
         );
        //REEMPLAZAR HASH SIN REGENERAR
        $ref = new \ReflectionClass($author);
        $property = $ref->getProperty('password');
        $property->setAccessible(true);
        $property->setValue($author, $row['password']);

        return new Book(
            (int)$row['publication_id'],
            $row['title'],
            $row['description'],
            new \DateTime($row['publication_date']),
            $author,
            $row['isbn'],
            $row['genre'],
            $row['edition'],
        );
    }

    public function findAll(): array{
        $stmt = $this->db->query('CALL sp_book_list();');
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();

        $out = [];
        foreach ($rows as $r){
            $out[] = $this->hydrate($r);
        }
        return $out;
    }

    public function create(object $entity): bool{
        
    }
    public function findById(int $id): ?object{
        
    }
    public function update(object $entity): bool{
        
    }
    public function delete(int $id): bool{};

    
}

// TAREA: Crear main y llamar a AuthorRepository y BookRepository y demostrar que funcionan correctamente.
//Crear articulo
