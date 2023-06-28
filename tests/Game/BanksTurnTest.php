<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

class BanksTurnTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $banksTurn = new BanksTurn();
        $this->assertInstanceOf("\App\Game\BanksTurn", $banksTurn);
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
        $endRound = $this->createMock(EndRound::class);
        $endRound->expects($this->once())
            ->method('main')
            ->with($this->equalTo($game));
        $banksTurn = new BanksTurn($endRound);

        $game->method('generateFlash')->willReturn(["custom", "testing bankDraw"]);
        $exp = ["custom", "testing bankDraw"];
        $res = $banksTurn->main($game);
        $this->assertEquals($exp, $res);
    }
}
