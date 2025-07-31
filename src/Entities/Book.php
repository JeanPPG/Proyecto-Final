<?php

declare(strict_types=1);

namespace App\Entities;

class Book extends Publication
{
    private string $isbn;
    private int $page_count;
    private string $publisher;
    private string $language;
    private string $format;
    private string $edition;
    private float $price;
    private array $genres;

    public function __construct(
        int $id,
        string $title,
        string $description,
        \DateTime $publication_date,
        Author $author,
        string $isbn,
        int $page_count,
        string $publisher,
        string $language,
        string $format,
        string $edition,
        float $price,
        array $genres
    ) {
        parent::__construct($id, $title, $description, $publication_date, $author);
        $this->isbn = $isbn;
        $this->page_count = $page_count;
        $this->publisher = $publisher;
        $this->language = $language;
        $this->format = $format;
        $this->edition = $edition;
        $this->price = $price;
        $this->genres = $genres;
    }

    /* Getters */

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getPageCount(): int
    {
        return $this->page_count;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getEdition(): string
    {
        return $this->edition;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    /* Setters */

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setPageCount(int $page_count): void
    {
        $this->page_count = $page_count;
    }

    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    public function setEdition(string $edition): void
    {
        $this->edition = $edition;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }
}
