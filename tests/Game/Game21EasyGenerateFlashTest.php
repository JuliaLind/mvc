<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class Game21Easy generateFlash() method
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

        $bank = clone $player;
        $player->method('getName')->willReturn('Player');
        $bank->method('getName')->willReturn('Bank');

        $game = new Game21Easy();
        $game->setWinner($player);
        $game->setRoundOver(true);

        $res = $game->generateFlash();
        $exp = ["notice", "Round over, Player won!"];
        $this->assertEquals($exp, $res);

        $game = new Game21Easy();
        $game->setWinner($bank);
        $game->setRoundOver(true);


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

        $player->method('getName')->willReturn('Player');
        $bank->method('getName')->willReturn('Bank');

        $game = new Game21Easy();
        $game->setRoundOver(true);
        $game->setFinished(true);
        $game->setWinner($player);

        $res = $game->generateFlash();
        $exp = ["notice", "Game over, Player won!"];
        $this->assertEquals($exp, $res);

        $game = new Game21Easy();
        $game->setRoundOver(true);
        $game->setFinished(true);
        $game->setWinner($bank);

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
