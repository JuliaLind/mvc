<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;
use App\Game\Player21;

/**
 * Test cases for class Game.
 */
class Game21Test extends TestCase
{
    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $game = new Game21();
        $this->assertInstanceOf("\App\Game\Game21", $game);

        $res = $game->gameOver();
        $exp = false;
        $this->assertEquals($exp, $res);
    }
}
