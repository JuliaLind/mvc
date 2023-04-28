<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\CardGraphic;
use App\Cards\DeckOfCards;

/**
 * Test cases for class Player21.
 */
class Player21Test extends TestCase
{
    private Player21 $player;
    private DeckOfCards $deck;

    protected function setUp(): void
    {
        $this->player = new Player21();
        $this->deck = $this->createMock(DeckOfCards::class);
        $card = $this->createMock(CardGraphic::class);
        $card2 = clone $card;
        $card3 = clone $card;
        $card4 = clone $card;
        $card5 = clone $card;
        $card6 = clone $card;
        $card7 = clone $card;
        $card->method('getIntValue')->willReturn(14);
        $card2->method('getIntValue')->willReturn(14);
        $card3->method('getIntValue')->willReturn(6);
        $card4->method('getIntValue')->willReturn(14);
        $card5->method('getIntValue')->willReturn(11);
        $card6->method('getIntValue')->willReturn(13);
        $card7->method('getIntValue')->willReturn(14);

        $this->deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5, $card6, $card7));
        $this->deck->method('getCardCount')->will($this->onConsecutiveCalls(6, 4, 3, 2, 1, 0));
        $this->deck->method('getValues')->will(
            $this->onConsecutiveCalls(
                [ 14, 6, 14, 11, 13, 14 ],
                [ 14, 11, 13, 14 ],
                [ 11, 13, 14 ],
                [ 13, 14 ],
                [ 14 ]
            )
        );
    }

    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        // $player = new Player('Julia');
        $this->assertInstanceOf("\App\Game\Player21", $this->player);

        $res = $this->player->getName();
        $exp = 'You';
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the handVlaue method by checking
     * that Ace counts as 14 up to total of 21
     * and above 21 as 1
     */
    public function testHandValue(): void
    {
        $loops = 3;
        while (--$loops >= 0) {
            $this->player->draw($this->deck);
        }

        $res = $this->player->handValue();
        $exp = 14 + 1 + 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the minHandValue method by checking that
     * all Aces are valued at 1
     */
    public function testMinHandValue(): void
    {
        $loops = 3;
        while (--$loops >= 0) {
            $this->player->draw($this->deck);
        }

        $res = $this->player->minHandValue();
        $exp = 1 + 1 + 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that estimating risk is calculated correctly
     */
    public function testEstimateRisk(): void
    {
        $this->player->draw($this->deck);
        $res = $this->player->estimateRisk($this->deck);
        // min value of hand is 1 (14)
        $exp = 0;
        $this->assertEquals($exp, $res);

        $this->player->draw($this->deck);
        $this->player->draw($this->deck);
        $res = $this->player->estimateRisk($this->deck);
        // min value of hand is 8 (14 + 14 + 6)
        $exp = 0;
        $this->assertEquals($exp, $res);

        $this->player->draw($this->deck);
        $res = $this->player->estimateRisk($this->deck);
        // min value of hand is 9 (14 + 14 + 6 + 14)
        // left in deck is 11, 13, 14
        $possibleCards = 3;
        $badCards = 1;
        $exp = $badCards/$possibleCards;
        $this->assertEquals($exp, $res);

        $this->player->draw($this->deck);
        $res = $this->player->estimateRisk($this->deck);
        // min value of hand is 20
        $possibleCards = 2;
        $badCards = 1;
        $exp = $badCards/$possibleCards;
        $this->assertEquals($exp, $res);

        $this->player->draw($this->deck);
        $res = $this->player->estimateRisk($this->deck);
        // min value of hand is above 21
        $exp = 1;
        $this->assertEquals($exp, $res);
    }
}
