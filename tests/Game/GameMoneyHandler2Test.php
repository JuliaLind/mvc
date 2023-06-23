<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameMoneyHandler.
 */
class GameMoneyHandler2Test extends TestCase
{
    /**
     * Tests the bet method
     */
    public function testBet(): void
    {
        $gameHandler = new GameMoneyHandler2();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('addToMoneyPot')
            ->with($this->equalTo(30));
        $gameHandler->bet(30, $game);
    }
}
