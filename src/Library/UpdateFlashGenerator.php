<?php

namespace App\Library;

use App\Entity\Book;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Generates flash messages for the Library
 */
class UpdateFlashGenerator
{
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
}
