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
        $gameHandler = new BanksTurnHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('dealBank');
        $game->expects($this->once())
            ->method('evaluateBank');
        $game->expects($this->once())
            ->method('endRound');

        $game->method('generateFlash')->willReturn(["custom", "testing bankDraw"]);
        $exp = ["custom", "testing bankDraw"];
        $res = $gameHandler->bankDraw($game);
        $this->assertEquals($exp, $res);
    }
}
