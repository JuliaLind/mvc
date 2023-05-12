<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class Game21Easy evaluate() method
 */
class Game21EasyEvaluateTest extends TestCase
{
    /**
     * Tests the evaluate method if player did
     * not get above 21
     */
    public function testEvaluateUnder21(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;
        $player->method('handValue')->willReturn(1);
        $player->method('getName')->willReturn('Player');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);
        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'',
            'cardsLeft'=>1,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the evaluate method if player did
     * not get above 21
     */
    public function testEvaluateAbove21(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;
        $player->method('handValue')->willReturn(22);
        $player->method('getName')->willReturn('Player');
        $bank->method('getName')->willReturn('Bank');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);

        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Bank',
            'cardsLeft'=>1,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the evaluate method if player did
     * not get above 21
     */
    public function testEvaluateAt21(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;
        $player->method('handValue')->willReturn(21);
        $player->method('getName')->willReturn('Player');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);


        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>true,
            'winner'=>'',
            'cardsLeft'=>1,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the evaluate method if player did
     * not get above 21 but there are no cards left
     */
    public function testEvaluateNoCradsLeft(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;
        $player->method('handValue')->willReturn(1);
        $player->method('getName')->willReturn('Player');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0);

        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);

        $game->setBank($bank);
        $game->setMoneyPot($pot);

        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Player',
            'cardsLeft'=>0,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }
}
