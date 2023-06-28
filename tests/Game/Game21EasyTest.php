<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class Game.
 */
class Game21EasyTest extends TestCase
{
    /**
     * Construct object and check that properties have
     * correct starting values by asserting outcome
     * from getGameStatus method
     */
    public function testCreateObject(): void
    {
        $game = new Game21Easy();
        $this->assertInstanceOf("\App\Game\Game21Easy", $game);

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => false,
            'winner' => '',
            'cardsLeft' => 52,
            'finished'=> false,
            'currentRound'=> 0,
            'moneyPot' => 0,
            'roundOver' => false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);

        $res = $game->getPlayerData();
        $exp = [
            [
                'name' => 'Bank',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ],
            [
                'name' => 'You',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ]
            ];
        $this->assertEquals($exp, $res);

        $res = $game->getRisk();
        $exp = '0 %';
        $this->assertEquals($exp, $res);
    }

    // /**
    //  * Tests the deal method
    //  */
    // public function testDeal(): void
    // {
    //     $deck = $this->createMock(DeckOfCards::class);
    //     $player = $this->createMock(Player21::class);
    //     $player->expects($this->once())
    //             ->method('draw')
    //             ->with($this->equalTo($deck));

    //     $game = new Game21Easy($player, $deck);
    //     $game->deal();
    // }


    // /**
    //  * Tests the getRisk() method that correct values are
    //  * returned when player it's player's turn
    //  */
    // public function testGetRiskPlayer(): void
    // {
    //     $player = $this->createMock(Player21::class);
    //     $player->method('estimateRisk')->willReturn(0.6758);
    //     $game = new Game21Easy($player);
    //     $res = $game->getRisk();
    //     $exp = '67.58 %';
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Tests the getRisk() method that correct values are
    //  * returned when player it's bank's turn
    //  */
    // public function testGetRiskBank(): void
    // {
    //     $deck = $this->createMock(DeckOfCards::class);
    //     $player = $this->createMock(Player21::class);
    //     $bank = clone $player;

    //     $player->method('estimateRisk')->willReturn(0.6758);
    //     $bank->method('estimateRisk')->willReturn(0.3389);

    //     $game = new Game21Easy($player, $deck);
    //     $game->setBank($bank);
    //     $game->setBankPlaying(true);

    //     $res = $game->getRisk();
    //     $exp = '33.89 %';
    //     $this->assertEquals($exp, $res);
    // }
}
