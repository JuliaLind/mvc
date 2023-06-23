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
class RoundHandler2Test extends TestCase
{
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

        $handler = new RoundHandler2();
        $res = $handler->nextRound($game);
        $exp = [
            'limit' => 70,
            'money' => 90,
            'round' => 4,
        ];
        $this->assertSame($exp, $res);
    }
}
