<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class Game21Hard class.
 */
class Game21HardTest extends TestCase
{
    /**
     * Construct object and check that properties have
     * correct starting values by asserting outcome
     * from getGameStatus method
     */
    public function testCreateObject(): void
    {
        $game = new Game21Hard();
        $this->assertInstanceOf("\App\Game\Game21Hard", $game);

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => false,
            'winner' => '',
            'cardsLeft' => 52,
            'finished'=> false,
            'currentRound'=> 0,
            'moneyPot' => 0,
            'roundOver' => false,
            'level' => 'hard',
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the dealBank method, bank picks as long as risk is below 50% and stops when 50%
     */
    public function testDealBank(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $bank->method('estimateRisk')->will($this->onConsecutiveCalls(0, 0.3, 0.49, 0.5, 0.7));
        $bank->expects($this->exactly(3))
                ->method('draw')
                ->with($this->equalTo($deck));

        $game = new Game21Hard($player, $deck);
        $game->setBank($bank);
        $game->dealBank();


        $res = $game->isBankPlaying();
        $this->assertTrue($res);
    }

    /**
     * Tests the dealBank method, bank picks as long as risk is below 50% but stops when nu cards left in deck
     */
    public function testDealBankNoCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(1, 1, 0));

        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $bank->method('estimateRisk')->will($this->onConsecutiveCalls(0, 0.3, 0.49, 0.5, 0.7));
        $bank->expects($this->exactly(2))
                ->method('draw')
                ->with($this->equalTo($deck));

        $game = new Game21Hard($player, $deck);
        $game->setBank($bank);
        $game->dealBank();


        $res = $game->isBankPlaying();
        $this->assertTrue($res);
    }
}
