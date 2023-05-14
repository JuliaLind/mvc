<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class Game21Easy endRound() method
 */
class RoundHandlerTest extends TestCase
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

        $handler = new RoundHandler();
        $handler->endRound($game);
    }

    public function testDeterminePlayerWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(80);
        $bank->method('getMoney')->willReturn(30);
        $handler = new RoundHandler();
        $res = $handler->determineWinner($player, $bank);
        $exp = $player;
        $this->assertSame($exp, $res);
    }

    public function testDetermineBankWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(30);
        $bank->method('getMoney')->willReturn(80);
        $handler = new RoundHandler();
        $res = $handler->determineWinner($player, $bank);
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
        $handler = new RoundHandler();
        $handler->finishGame($game);
    }

    public function testNextRound(): void
    {
        $player = $this->createMock(Player21::class);
        $player->expects($this->once())->method('emptyHand');
        $player->method('getMoney')->wilLReturn(90);
        $bank = $this->createMock(Player21::class);
        $bank->expects($this->once())->method('emptyHand');

        $game = $this->createMock(Game21Easy::class);
        $game->method('getCurrentRound')->will($this->onConsecutiveCalls(3, 4));
        $game->expects($this->once())->method('setCurrentRound')->with($this->equalTo(4));
        $game->expects($this->once())->method('setRoundOver')->with($this->equalTo(false));
        $game->expects($this->once())->method('setBankPlaying')->with($this->equalTo(false));
        $game->method('getPlayer')->willreturn($player);
        $game->method('getBank')->willreturn($bank);
        $game->expects($this->once())->method('setWinner')->with($this->equalTo(new Player21('')));
        $game->method('getInvestLimit')->willReturn(70);

        $handler = new RoundHandler();
        $res = $handler->nextRound($game);
        $exp = [
            'limit' => 70,
            'money' => 90,
            'round' => 4,
        ];
        $this->assertSame($exp, $res);
    }
}
