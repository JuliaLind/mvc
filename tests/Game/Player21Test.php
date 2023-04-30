<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

/**
 * Test cases for class Player21.
 */
class Player21Test extends TestCase
{
    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $player = new Player21();
        $this->assertInstanceOf("\App\Game\Player21", $player);

        $res = $player->getName();
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
        $hand = $this->createMock(CardHand::class);
        $hand->method('getValues')->willReturn([14, 14, 6]);
        $player = new Player21('', $hand);


        $res = $player->handValue();
        $exp = 14 + 1 + 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the minHandValue method by checking that
     * all Aces are valued at 1
     */
    public function testMinHandValue(): void
    {
        $hand = $this->createMock(CardHand::class);
        $hand->method('getValues')->willReturn([14, 14, 6]);
        $player = new Player21('', $hand);

        $res = $player->minHandValue();
        $exp = 1 + 1 + 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that estimating risk is calculated correctly
     */
    public function testEstimateRisk(): void
    {
        $hand = $this->createMock(CardHand::class);
        $hand->method('getValues')->will(
            $this->onConsecutiveCalls(
                [14],
                [14, 14, 6],
                [14, 14, 6, 14],
                [14, 14, 6, 14, 11],
                [14, 14, 6, 14, 11, 13],
            )
        );

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->will(
            $this->onConsecutiveCalls(6, 4, 3, 2, 1, 0)
        );

        $deck->method('getValues')->will(
            $this->onConsecutiveCalls(
                [14, 6, 14, 11, 13, 14],
                [14, 11, 13, 14],
                [11, 13, 14],
                [13, 14],
                [14]
            )
        );

        $player = new Player21('', $hand);
        $res = $player->estimateRisk($deck);
        $exp = 0;
        $this->assertEquals($exp, $res);


        $res = $player->estimateRisk($deck);
        $exp = 0;
        $this->assertEquals($exp, $res);


        $res = $player->estimateRisk($deck);
        $possibleCards = 3;
        $badCards = 1;
        $exp = $badCards/$possibleCards;
        $this->assertEquals($exp, $res);


        $res = $player->estimateRisk($deck);
        $possibleCards = 2;
        $badCards = 1;
        $exp = $badCards/$possibleCards;
        $this->assertEquals($exp, $res);

        $res = $player->estimateRisk($deck);
        $exp = 1;
        $this->assertEquals($exp, $res);
    }
}
