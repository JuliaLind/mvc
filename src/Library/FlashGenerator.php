<?php

namespace App\Library;

use App\Entity\Book;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Generates flash messages for the Library
 */
class FlashGenerator
{
    /**
     * Generates class and text for flashmessage
     * for route for new book
     * @return array<string>
     */
    public function newFlash(bool $bool, Book $book): array
    {
        switch ($bool) {
            case true:
                return [
                    "notice",
                    "Boken '{$book->getTitle()}' är registrerad. Klicka på kryset till höger för att gå till översikten"
                ];
            default:
                return  [
                    "warning",
                    "En bok med isbn '{$book->getIsbn()}' finns redan i systemet. ISBN nummer måste vara unik"
                ];
        }
    }

    /**
     * Generates class and text for flashmessage
     * for route for update book
     * @return array<string>
     */
    public function updateFlash(bool $bool, Book $book): array
    {
        switch ($bool) {
            case false:
                return [
                    "warning",
                    "En annan bok med isbn '{$book->getIsbn()}' finns redan i systemet"
                ];
            default:
                return ["", ""];
        };
    }

    /**
     * Generates class and text for flashmessage
     * for route for removing book
     * @return array<string>
     */
    public function removeFlash(Book $book): array
    {
        return [
            "warning",
            "Boken '{$book->getTitle()}' har raderats"
        ];
    }
}
