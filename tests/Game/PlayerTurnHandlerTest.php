<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameHandler.
 */
class PlayerTurnHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new PlayerTurnHandler();
        $this->assertInstanceOf("\App\Game\PlayerTurnHandler", $gameHandler);
    }

    /**
     * Tests the playerDraw method
     */
    public function testPlayerDrawRoundOver(): void
    {
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('deal');
        $game->expects($this->once())
            ->method('evaluate')
            ->willReturn(true);
        // $game->expects($this->once())
        //     ->method('endRound');

        $handler = $this->createMock(RoundHandler::class);
        $handler->expects($this->once())
            ->method('endRound')
            ->with($this->equalTo($game));
        $gameHandler = new PlayerTurnHandler($handler);
        $game->method('generateFlash')->willReturn(["custom", "testing playerDraw"]);
        $exp = ["custom", "testing playerDraw"];
        $res = $gameHandler->playerDraw($game);
        $this->assertEquals($exp, $res);
    }

        /**
     * Tests the playerDraw method
     */
    public function testPlayerDrawRoundNotOver(): void
    {
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('deal');
        $game->expects($this->once())
            ->method('evaluate')
            ->willReturn(false);

        $handler = $this->createMock(RoundHandler::class);
        $handler->expects($this->never())
             ->method('endRound');
        $gameHandler = new PlayerTurnHandler($handler);
        $gameHandler->playerDraw($game);
    }
}