<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Game.
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
            'risk'=> '0 %',
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
    public function testDealBankCardsLeftNotOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $cardValues = [13, 3, 3, 7, 2, 7];
        $cards = [];
        foreach($cardValues as $value) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getIntValue')->willReturn($value);
            $cards[] = $card;
        }

        $deckValues = [[13, 3, 3, 7, 2, 7], [3, 3, 7, 2, 7], [3, 7, 2, 7], [7, 2, 7], [2, 7], [7]];


        $deck->method('draw')->will($this->onConsecutiveCalls(...$cards));
        $deck->method('getValues')->will($this->onConsecutiveCalls(...$deckValues));
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(6, 6, 5, 5, 4, 4, 3, 3, 2, 2, 1, 1, 0));

        $player = $this->createMock(Player21::class);

        $bank = new Player21('Bank');
        $game = new Game21Hard($player, $deck, $bank);

        $game->dealBank();
        $res = $bank->getCardValues();
        $exp = [13, 3];

        $this->assertEquals($exp, $res);

        $res = $game->getGameStatus()['bankPlaying'];
        $exp = true;
        $this->assertEquals($exp, $res);
    }
}
