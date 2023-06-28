<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";


class EndRoundTest extends TestCase
{
    /**
     * Tests the end round method if there are no
     * cards left in deck and final winner is not
     * the same player who won the last round
     */
    public function testEndRoundNoCardsLeftNotSameFinalWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getName')->willReturn('player');
        $bank->method('getName')->willReturn('bank');
        $player->method('getMoney')->willReturn(80);
        $bank->method('getMoney')->willReturn(30);

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('moneyToWinner')
            ->with($this->equalTo($bank));
        $pot->method('currentAmount')->willReturn(0);

        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())->method('getInvestLimit')
            ->willReturn(1);
        $game->method('cardsLeft')->willReturn(0);

        $game->expects($this->once())->method('getWinner')
            ->willReturn($bank);
        $game->method('getBank')->willReturn($bank);
        $game->method('getPlayer')->willReturn($player);
        $game->method('getMoneyPot')->willReturn($pot);

        $game->expects($this->once())->
            method('setWinner')->with($this->equalTo($bank));

        $endRound = new EndRound();
        $endRound->main($game);
    }

    public function testDeterminePlayerWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(80);
        $bank->method('getMoney')->willReturn(30);
        $endRound = new EndRound();
        $res = $endRound->determineWinner($player, $bank);
        $exp = $player;
        $this->assertSame($exp, $res);
    }

    public function testDetermineBankWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(30);
        $bank->method('getMoney')->willReturn(80);
        $endRound = new EndRound();
        $res = $endRound->determineWinner($player, $bank);
        $exp = $bank;
        $this->assertSame($exp, $res);
    }

    public function testFinishGame(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->willReturn(0);

        $game = $this->createMock(Game21Easy::class);
        $game->method('getInvestLimit')->willReturn(0);
        $game->method('getMoneyPot')->willReturn($pot);
        $game->expects($this->once())->method('setFinished')->with($this->equalTo(true));
        $endRound = new EndRound();
        $endRound->finishGame($game);
    }
}
