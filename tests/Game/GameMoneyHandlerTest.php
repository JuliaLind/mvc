<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameMoneyHandler.
 */
class GameMoneyHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new GameMoneyHandler();
        $this->assertInstanceOf("\App\Game\GameMoneyHandler", $gameHandler);
    }

    /**
     * Tests the selectAmount method
     */
    public function testSelectAmount(): void
    {
        $gameHandler = new GameMoneyHandler();
        $roundHandler = $this->createMock(RoundHandler2::class);
        $game = $this->createMock(Game21Easy::class);
        $roundHandler->expects($this->once())
            ->method('nextRound')->with($this->identicalTo($game))
            ->willReturn([
                'limit' => 50,
                'money' => 40,
                'round' => 5,
            ]);

        $exp = [
            'limit' => 50,
            'money' => 40,
            'round' => 5,
            'page' => "game no-header card",
            'url' => "/game",
        ];

        $res = $gameHandler->selectAmount($game, $roundHandler);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the bet method
     */
    public function testBet(): void
    {
        $gameHandler = new GameMoneyHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('addToMoneyPot')
            ->with($this->equalTo(30));
        $gameHandler->bet(30, $game);
    }
}
