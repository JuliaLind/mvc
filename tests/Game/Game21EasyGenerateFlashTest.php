<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Game.
 */
class Game21EasyGenerateFlashTest extends TestCase
{
    /**
     * Tests that correct flashmessage is generated
     * when round is over
     */
    public function testGenerateFlashRoundOver(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getMoney')->willReturn(1);
        $bank = clone $player;
        $player->method('getName')->willReturn('Player');
        $bank->method('getName')->willReturn('Bank');
        $player->method('handValue')->will($this->onConsecutiveCalls(21, 21));
        $bank->method('handValue')->will($this->onConsecutiveCalls(25, 21));


        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $game = new Game21Easy($player, $deck, $bank);

        $game->evaluateBank();
        $game->endRound();
        $res = $game->generateFlash();
        $exp = ["notice", "Round over, Player won!"];
        $this->assertEquals($exp, $res);

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluateBank();
        $game->endRound();
        $res = $game->generateFlash();
        $exp = ["warning", "Round over, Bank won!"];
        $this->assertEquals($exp, $res);
    }


    /**
     * Tests that correct flashmessage is generated
     * when game is over
     */
    public function testGenerateFlashGameOver(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = clone $player;
        $player->method('getMoney')->will($this->onConsecutiveCalls(80, 80, 30, 30));
        $bank->method('getMoney')->will($this->onConsecutiveCalls(30, 30, 80, 80));
        $player->method('getName')->willReturn('Player');
        $bank->method('getName')->willReturn('Bank');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0);

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluateBank();
        $game->endRound();
        $res = $game->generateFlash();
        $exp = ["notice", "Game over, Player won!"];
        $this->assertEquals($exp, $res);

        $game = new Game21Easy($player, $deck, $bank);
        $game->evaluateBank();
        $game->endRound();
        $res = $game->generateFlash();
        $exp = ["warning", "Game over, Bank won!"];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that array with empty strings is generated
     * when the round is not over
     */
    public function testGenerateFlashRoundNotOver(): void
    {
        $game = new Game21Easy();
        $res = $game->generateFlash();
        $exp = ["", ""];
        $this->assertEquals($exp, $res);
    }
}
