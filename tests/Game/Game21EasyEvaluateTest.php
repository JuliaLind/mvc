<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

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

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'',
            'cardsLeft'=>1,
            'risk'=> '0 %',
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

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Bank',
            'cardsLeft'=>1,
            'risk'=> '0 %',
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
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

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>true,
            'winner'=>'',
            'cardsLeft'=>1,
            'risk'=> '0 %',
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

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluate();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Player',
            'cardsLeft'=>0,
            'risk'=> '0 %',
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }
}
