<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for class GameHandler.
 */
class BanksTurnHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new BanksTurnHandler();
        $this->assertInstanceOf("\App\Game\BanksTurnHandler", $gameHandler);
    }

    /**
     * Tests the bankDraw method
     */
    public function testBankDraw(): void
    {
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('dealBank');
        $game->expects($this->once())
            ->method('evaluateBank');
        $handler = $this->createMock(RoundHandler::class);
        $handler->expects($this->once())
            ->method('endRound')
            ->with($this->equalTo($game));
        $gameHandler = new BanksTurnHandler($handler);




        $game->method('generateFlash')->willReturn(["custom", "testing bankDraw"]);
        $exp = ["custom", "testing bankDraw"];
        $res = $gameHandler->bankDraw($game);
        $this->assertEquals($exp, $res);
    }
}
