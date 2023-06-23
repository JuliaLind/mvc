<?php

namespace App\Library;

use App\Entity\Book;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Generates flash messages for when user removes a book from the Library
 */
class RemoveFlashGenerator
{
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
