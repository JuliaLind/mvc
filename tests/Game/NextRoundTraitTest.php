<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

class NextRoundTraitTest extends TestCase
{
    use NextRoundTrait;

    protected function getInvestLimit(): int
    {
        return 50;
    }

    public function testNextRound(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->expects($this->once())->method('emptyHand');
        $bank->expects($this->once())->method('emptyHand');

        $player->method('getMoney')->willReturn(80);
        $this->bank = $bank;
        $this->player = $player;
        $this->currentRound = 8;
        $this->roundOver = true;
        $this->bankPlaying = true;
        $this->winner = $player;

        $res = $this->nextRound();
        $exp = [
            'limit' => 50,
            'money' => 80,
            'round' => 9,
        ];
        $this->assertEquals($exp, $res);
        $this->assertNotSame($player, $this->winner);
        $this->assertFalse($this->roundOver);
        $this->assertFalse($this->bankPlaying);
    }
}
