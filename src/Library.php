<?php
namespace App;

class Library {
    private array $books = [];

    public function addBook(Book $book): void {
        $this->books[] = $book;
    }

    public function removeBookByTitle(string $title): bool {
        foreach ($this->books as $key => $book) {
            if ($book->getTitle() === $title) {
                unset($this->books[$key]);
                return true; 
            }
        }
        return false; 
    }

    public function findBooksByAuthor(string $author): array {
        $foundBooks = [];
        foreach ($this->books as $book) {
            if ($book->getAuthor() === $author) {
                $foundBooks[] = $book;
            }
        }
        return $foundBooks;
    }

    public function listAllBooks(): array {
        $allBooksInfo = [];
        foreach ($this->books as $book) {
            $allBooksInfo[] = $book->getBookInfo();
        }
        return $allBooksInfo;
    }
}
