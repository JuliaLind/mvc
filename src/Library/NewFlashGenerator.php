<?php

namespace App\Library;

use App\Entity\Book;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Generates flash messages for the Library
 */
class NewFlashGenerator
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
}
