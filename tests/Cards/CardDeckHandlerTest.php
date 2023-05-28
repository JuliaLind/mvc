<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for CardHandles class
 */
class CardDeckHandlerTest extends TestCase
{
    /**
     * Construct one of the "ordinary" cards and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $cardHandler = new CardDeckHandler();
        $this->assertInstanceOf("\App\Cards\CardDeckHandler", $cardHandler);
    }

    /**
     * Tests that getRouteData method returns correct data
     */
    public function testGetDeckRouteData(): void
    {
        $cardHandler = new CardDeckHandler();
        $deck = $this->createMock(DeckOfCards::class);
        $deck->expects($this->once())
            ->method('getImgLinks')
            ->willReturn(['alink.png', 'anotherlink.png']);
        $exp = [
            'title' => "New deck",
            'cards' => ['alink.png', 'anotherlink.png'],
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        $res = $cardHandler->getDeckRouteData($deck);
        $this->assertEquals($exp, $res);
    }
}
