<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

use App\Cards\DeckOfCards;

class EndRoundTraitTest extends TestCase
{
    use EndRoundTrait;

    protected int $investLimit = 0;

    protected function getInvestLimit(): int
    {
        return $this->investLimit;
    }

    public function testDetermineWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(20);
        $bank->method('getMoney')->willReturn(100);
        $this->player = $player;
        $this->bank = $bank;
        $res = $this->determineWinner();
        $exp = $bank;
        $this->assertSame($exp, $res);

        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(100);
        $bank->method('getMoney')->willReturn(20);
        $this->player = $player;
        $this->bank = $bank;
        $res = $this->determineWinner();
        $exp = $player;
        $this->assertSame($exp, $res);
    }

    public function testFinishGame(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->will($this->onConsecutiveCalls(20, 0, 0));
        $this->moneyPot = $pot;
        $this->finishGame();
        $this->assertFalse($this->finished);

        $this->investLimit = 5;
        $this->finishGame();
        $this->assertFalse($this->finished);

        $this->investLimit = 0;
        $this->finishGame();
        $this->assertTrue($this->finished);
    }

    public function testGameOver(): void
    {
        $this->assertFalse($this->gameOver());
        $this->finished = true;
        $this->assertTrue($this->gameOver());
    }

    public function testEndRound1(): void
    {
        $player = $this->createMock(Player21::class);
        $this->winner = $player;
        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())->method('moneyToWinner')->with($this->equalTo($player));
        $this->moneyPot = $pot;
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);
        $this->deck = $deck;

        $this->endRound();
        $this->assertSame($player, $this->winner);
        $this->assertTrue($this->roundOver);
        $this->assertFalse($this->finished);
    }

    public function testEndRound2(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(20);
        $bank->method('getMoney')->willReturn(100);

        $this->winner = $player;
        $this->player = $player;
        $this->bank = $bank;

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())->method('moneyToWinner')->with($this->equalTo($player));
        $pot->method('currentAmount')->willReturn(0);
        $this->moneyPot = $pot;
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0);
        $this->deck = $deck;

        $this->endRound();
        $this->assertSame($bank, $this->winner);
        $this->assertTrue($this->roundOver);
        $this->assertTrue($this->finished);
    }
}
