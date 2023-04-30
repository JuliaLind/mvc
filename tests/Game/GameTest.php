<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $game = new Game();
        $this->assertInstanceOf("\App\Game\Game", $game);

        $res = $game->gameOver();
        $exp = false;
        $this->assertEquals($exp, $res);

        $res = $game->cardsLeft();
        $exp = 52;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests cardsLeft method
     */
    public function testCardsLeftOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(30);

        $game = new Game($deck);
        $res = $game->cardsLeft();
        $exp = 30;
        $this->assertEquals($exp, $res);
    }
}
