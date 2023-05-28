<?php

namespace App\Library;

use App\Entity\Book;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class LibraryHandler
 */
class LibraryHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $handler = new LibraryHandler();
        $this->assertInstanceOf("\App\Library\LibraryHandler", $handler);
    }

    /**
     * Tests the updateOne method
     */
    public function testUpdateOne(): void
    {

        $request = $this->createMock('Symfony\Component\HttpFoundation\Request');

        $repo = $this->createMock(BookRepository::class);
        $book = $this->createMock(Book::class);
        $updator = $this->createMock(BookUpdator::class);
        $saver = $this->createMock(BookSaver::class);
        $flashGenerator = $this->createMock(UpdateFlashGenerator::class);

        $request->expects($this->once())
        ->method('get')
        ->with('book_id')
        ->willReturn(5);

        $repo->expects($this->once())
        ->method('find')
        ->with($this->equalTo(5))
        ->willReturn($book);

        $updator->expects($this->once())
        ->method('updateBook')
        ->with($this->equalTo($request), $this->equalTo($book));

        $saver->expects($this->once())
        ->method('saveBook')
        ->with($this->equalTo($repo), $this->equalTo($book))
        ->willReturn(true);

        $expFlash = [['test', 'test flashmessage']];
        $flashGenerator->expects($this->once())
        ->method('updateFLash')
        ->with($this->equalTo(true), $this->equalTo($book))
        ->willReturn($expFlash);

        $exp = [$expFlash, $book, true];

        $handler = new LibraryHandler($saver, $updator);
        $handler->setUpdateFlashGenerator($flashGenerator);
        $res = $handler->updateOne($request, $repo);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the ceateOne method
     */
    public function testCreateOne(): void
    {

        $request = $this->createMock('Symfony\Component\HttpFoundation\Request');
        $updator = $this->createMock(BookUpdator::class);
        $saver = $this->createMock(BookSaver::class);
        $repo = $this->createMock(BookRepository::class);
        $book = $this->createMock(Book::class);
        $updator = $this->createMock(BookUpdator::class);
        $saver = $this->createMock(BookSaver::class);
        $flashGenerator = $this->createMock(NewFlashGenerator::class);

        $updator->expects($this->once())
        ->method('updateBook')
        ->with($this->equalTo($request), $this->equalTo($book));

        $saver->expects($this->once())
        ->method('saveBook')
        ->with($this->equalTo($repo), $this->equalTo($book))
        ->willReturn(false);

        $expFlash = [['test', 'test flashmessage']];
        $flashGenerator->expects($this->once())
        ->method('newFlash')
        ->with($this->equalTo(false), $this->equalTo($book))
        ->willReturn($expFlash);

        $exp = [$expFlash, $book, false];

        $handler = new LibraryHandler($saver, $updator);
        $handler->setNewFlashGenerator($flashGenerator);
        $res = $handler->createOne($request, $repo, $book);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the removeOne method
     */
    public function testRemoveOne(): void
    {
        $updator = $this->createMock(BookUpdator::class);
        $saver = $this->createMock(BookSaver::class);

        $isbn = "01234567890123";
        $repo = $this->createMock(BookRepository::class);
        $book = $this->createMock(Book::class);
        $remover = $this->createMock(BookRemover::class);

        $flashGenerator = $this->createMock(RemoveFlashGenerator::class);

        $repo->expects($this->once())
        ->method('findOneByIsbn')
        ->with($this->equalTo($isbn))
        ->willReturn($book);

        $remover->expects($this->once())
        ->method('removeBook')
        ->with($this->equalTo($repo), $this->equalTo($book));

        $expFlash = [['test', 'test flashmessage']];
        $flashGenerator->expects($this->once())
        ->method('removeFlash')
        ->with($this->equalTo($book))
        ->willReturn($expFlash);

        $exp = $expFlash;

        $handler = new LibraryHandler($saver, $updator, $remover);
        $handler->setRemoveFlashGenerator($flashGenerator);
        $res = $handler->removeOne($repo, $isbn);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the setters and getters
     */
    public function testSettersGetters(): void
    {
        $updateFlashGenerator = $this->createMock(UpdateFlashGenerator::class);
        $newFlashGenerator = $this->createMock(NewFlashGenerator::class);
        $removeFlashGenerator = $this->createMock(RemoveFlashGenerator::class);

        $handler = new LibraryHandler();
        $handler->setUpdateFlashGenerator($updateFlashGenerator);
        $res = $handler->getUpdateFlashGenerator();
        $exp = $updateFlashGenerator;
        $this->assertEquals($exp, $res);

        $handler->setNewFlashGenerator($newFlashGenerator);
        $res = $handler->getNewFlashGenerator();
        $exp = $newFlashGenerator;
        $this->assertEquals($exp, $res);

        $handler->setRemoveFlashGenerator($removeFlashGenerator);
        $res = $handler->getRemoveFlashGenerator();
        $exp = $removeFlashGenerator;
        $this->assertEquals($exp, $res);
    }
}
