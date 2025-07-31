<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;

$authorRepo = new AuthorRepository();
$authors   = $authorRepo->findAll();

echo "=== Autores ===\n";
foreach ($authors as $a) {
    printf("[%d] %s %s\n", $a->getId(), $a->getFirstName(), $a->getLastName());
}

$bookRepo = new BookRepository();
$books    = $bookRepo->findAll();

echo "\n=== Libros ===\n";
foreach ($books as $b) {
    printf("%s — \"%s\"\n", $b->getIsbn(), $b->getTitle());
}

$articleRepo = new ArticleRepository();
$books    = $bookRepo->findAll();

echo "\n=== Articulos ===\n";
foreach ($article as $a) {
    printf("%s — \"%s\"\n", $a->getDoi(), $b->getJournal());
}