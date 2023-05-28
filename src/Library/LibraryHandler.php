<?php

namespace App\Library;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Book;
use App\Repository\BookRepository;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle som of the
 * funcitonality in the LibraryController
 */
class LibraryHandler
{
    private BookSaver $saver;
    private BookUpdator $updator;
    private BookRemover $remover;
    private UpdateFlashGenerator $updateFlashGenerator;
    private NewFlashGenerator $newFlashGenerator;
    private RemoveFlashGenerator $removeFlashGenerator;

    /**
     * Constructor
     */
    public function __construct(
        BookSaver $saver = new BookSaver(),
        BookUpdator $updator = new BookUpdator(),
        BookRemover $remover=new BookRemover(),
    ) {
        $this->saver = $saver;
        $this->updator = $updator;
        $this->remover = $remover;
        $this->updateFlashGenerator = new UpdateFlashGenerator();
        $this->newFlashGenerator = new NewFlashGenerator();
        $this->removeFlashGenerator = new RemoveFlashGenerator();
    }


    public function setUpdateFlashGenerator(
        UpdateFlashGenerator $flashGenerator = new UpdateFlashGenerator(),
    ): void {
        $this->updateFlashGenerator = $flashGenerator;
    }

    public function setNewFlashGenerator(
        NewFlashGenerator $flashGenerator = new NewFlashGenerator(),
    ): void {
        $this->newFlashGenerator = $flashGenerator;
    }

    public function setRemoveFlashGenerator(
        RemoveFlashGenerator $flashGenerator = new RemoveFlashGenerator(),
    ): void {
        $this->removeFlashGenerator = $flashGenerator;
    }


    public function getUpdateFlashGenerator(): UpdateFlashGenerator
    {
        return $this->updateFlashGenerator;
    }

    public function getNewFlashGenerator(): NewFlashGenerator
    {
        return $this->newFlashGenerator;
    }

    public function getRemoveFlashGenerator(): RemoveFlashGenerator
    {
        return $this->removeFlashGenerator;
    }

    protected function updateAndSave(Request $request, Book $book, BookRepository $bookRepository): bool
    {
        $this->updator->updateBook($request, $book);
        $wentWell = $this->saver->saveBook($bookRepository, $book);
        return $wentWell;
    }

    /**
     * Updates details of a book object
     * @return array<int,Book|array<string>|bool>
     */
    public function updateOne(Request $request, BookRepository $bookRepository): array
    {
        $bookId = $request->get('book_id');
        /**
         * @var Book $book
         */
        $book = $bookRepository->find($bookId);
        $wentWell = $this->updateAndSave($request, $book, $bookRepository);
        $flash = $this->updateFlashGenerator->updateFlash($wentWell, $book);
        return [$flash, $book, $wentWell];
    }

    /**
     * Updates details of a book object
     * @return array<int,Book|array<string>|bool>
     */
    public function createOne(Request $request, BookRepository $bookRepository, Book $book = new Book()): array
    {
        $wentWell = $this->updateAndSave($request, $book, $bookRepository);
        $flash = $this->newFlashGenerator->newFlash($wentWell, $book);

        return [$flash, $book, $wentWell];
    }

    /**
     * Removes a book
     * @return array<string>
     */
    public function removeOne(BookRepository $bookRepository, string $isbn): array
    {
        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn($isbn);
        $this->remover->removeBook($bookRepository, $book);
        $flash = $this->removeFlashGenerator->removeFlash($book);

        return $flash;
    }
}
