<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Game21Easy evaluateBank() metod.
 */
class Game21EasyEvaluateBankTest extends TestCase
{
    /**
     * Tests the evaluateBank method if both player and bank get 21
     */
    public function testEvaluateBankBoth21(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('Player');
        $player->method('handValue')->willReturn(21);

        $bank->method('getName')->willReturn('Bank');
        $bank->method('handValue')->willReturn(21);

        $deck = $this->createMock(DeckOfCards::class);
        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);

        $game->evaluateBank();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Bank',
            'cardsLeft'=>0,
            'finished'=>false,
            'currentRound'=>0,
            'moneyPot'=>0,
            'roundOver'=>false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the evaluateBank method if player has better hand
     */
    public function testEvaluateBankPlayerBetterHand(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('Player');
        $player->method('handValue')->willReturn(20);

        $bank->method('handValue')->willReturn(19);
        $bank->method('getName')->willReturn('Bank');

        $deck = $this->createMock(DeckOfCards::class);
        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);

        $game->evaluateBank();

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

    /**
     * Tests the evaluateBank method if bank gets above 21
     */
    public function testEvaluateBankAbove21(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('Player');
        $player->method('handValue')->willReturn(1);

        $bank->method('handValue')->willReturn(22);
        $bank->method('getName')->willReturn('Bank');

        $deck = $this->createMock(DeckOfCards::class);
        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setMoneyPot($pot);
        $game->setBank($bank);

        $game->evaluateBank();

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


    /**
     * Tests the evaluateBank method if bank wins
     */
    public function testEvaluateBankWin(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('getName')->willReturn('Player');
        $player->method('handValue')->willReturn(18);

        $bank->method('getName')->willReturn('Bank');
        $bank->method('handValue')->willReturn(19);

        $deck = $this->createMock(DeckOfCards::class);
        $pot = $this->createMock(MoneyPot::class);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setMoneyPot($pot);
        $game->evaluateBank();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying'=>false,
            'winner'=>'Bank',
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
