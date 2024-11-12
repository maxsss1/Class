<?php
require __DIR__ . '/vendor/autoload.php';

use App\Book;
use App\Library;

function getInput(string $prompt): string {
    echo $prompt;
    return trim(fgets(STDIN));
}

$library = new Library();

while (true) {
    echo "\n--- Меню ---\n";
    echo "1. Добавить книгу\n";
    echo "2. Удалить книгу по названию\n";
    echo "3. Найти книги по автору\n";
    echo "4. Показать все книги\n";
    echo "5. Выход\n";
    echo "Выберите действие: ";
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1': 
            $title = getInput("Введите название книги: ");
            $author = getInput("Введите автора книги: ");
            $publishedYear = (int)getInput("Введите год публикации книги: ");
            $genre = getInput("Введите жанр книги: ");
            $book = new Book($title, $author, $publishedYear, $genre);
            $library->addBook($book);
            echo "Книга добавлена!\n";
            break;

        case '2': 
            $title = getInput("Введите название книги для удаления: ");
            if ($library->removeBookByTitle($title)) {
                echo "Книга '$title' удалена.\n";
            } else {
                echo "Книга с названием '$title' не найдена.\n";
            }
            break;

        case '3': 
            $author = getInput("Введите имя автора: ");
            $foundBooks = $library->findBooksByAuthor($author);
            if (count($foundBooks) > 0) {
                echo "Книги автора '$author':\n";
                foreach ($foundBooks as $book) {
                    echo $book->getBookInfo() . "\n\n";
                }
            } else {
                echo "Книги автора '$author' не найдены.\n";
            }
            break;

        case '4': 
            echo "Все книги в библиотеке:\n";
            $allBooks = $library->listAllBooks();
            if (count($allBooks) > 0) {
                foreach ($allBooks as $bookInfo) {
                    echo $bookInfo . "\n\n";
                }
            } else {
                echo "Библиотека пуста.\n";
            }
            break;

        case '5': 
            echo "До свидания!\n";
            exit;

        default:
            echo "Неверный выбор. Пожалуйста, выберите правильный вариант.\n";
            break;
    }
}
