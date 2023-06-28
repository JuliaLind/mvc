<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

class PlayersTurnTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $playersTurn = new PlayersTurn();
        $this->assertInstanceOf("\App\Game\PlayersTurn", $playersTurn);
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
        //     ->method('main');

        $endRound = $this->createMock(EndRound::class);
        $endRound->expects($this->once())
            ->method('main')
            ->with($this->equalTo($game));
        $playersTurn = new PlayersTurn($endRound);
        $game->method('generateFlash')->willReturn(["custom", "testing playerDraw"]);
        $exp = ["custom", "testing playerDraw"];
        $res = $playersTurn->main($game);
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

        $endRound = $this->createMock(EndRound::class);
        $endRound->expects($this->never())
             ->method('main');
        $playersTurn = new PlayersTurn($endRound);
        $playersTurn->main($game);
    }
}
