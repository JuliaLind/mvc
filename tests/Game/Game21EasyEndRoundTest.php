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
class Game21EasyEndRoundTest extends TestCase
{
    /**
     * Tests the end round method if there are no
     * cards left in deck and final winner is not
     * the same player who won the last round
     */
    public function testEndRoundNoCardsLeftNotSameFinalWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('player');
        $player->method('getMoney')->willReturn(80);
        $bank->method('getMoney')->willReturn(30);

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0);

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('moneyToWinner')
            ->with($this->equalTo($bank));

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);
        $game->setWinner($bank);

        $game->endRound();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'player',
            'cardsLeft'=>0,
            'finished'=>true,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the end round method if there are no
     * cards left in deck and final winner is
     * the same player who won the last round
     */
    public function testEndRoundNoCardsLeftSameFinalWinner(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('player');
        $player->method('getMoney')->willReturn(80);

        $bank->method('getMoney')->willReturn(30);

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0);

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('moneyToWinner')
            ->with($this->equalTo($player));

        $game = new Game21Easy($player, $deck);

        $game->setBank($bank);
        $game->setWinner($player);
        $game->setMoneyPot($pot);

        $game->endRound();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'player',
            'cardsLeft'=>0,
            'finished'=>true,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the end round method if there are cards left in game
     * but bank is out of money
     */
    public function testEndRoundNoMoney(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn('Player');

        $bank = $this->createMock(Player21::class);


        $player->method('getMoney')->willReturn(80);
        $bank->method('getMoney')->willReturn(0);

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('moneyToWinner')
            ->with($this->equalTo($player));

        $game = new Game21Easy($player, $deck);

        $game->setBank($bank);
        $game->setWinner($player);
        $game->setMoneyPot($pot);

        $game->endRound();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Player',
            'cardsLeft'=>1,
            'finished'=>true,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the end round method if only
     * the round is over and not the whole game
     */
    public function testEndRound(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('Player');
        $player->method('getMoney')->willReturn(1);

        $bank->method('getName')->willReturn('Bank');
        $bank->method('getMoney')->willReturn(1);

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setWinner($bank);


        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
                 ->method('moneyToWinner')
                 ->with($this->equalTo($bank));

        $game->setMoneyPot($pot);
        $game->endRound();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Bank',
            'cardsLeft'=>1,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }
}
