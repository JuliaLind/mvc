<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

use App\Cards\DeckOfCards;

/**
 * Test cases for trait BettingGameTrait.
 */
class DealBankHardTraitTest extends TestCase
{
    use DealBankHardTrait;


    /**
     * Tests the dealBank method, bank picks as long as risk is below 50% and stops when 50%
     */
    public function testDealBank(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);


        $bank = $this->createMock(Player21::class);
        $bank->method('estimateRisk')->will($this->onConsecutiveCalls(0, 0.3, 0.49, 0.5, 0.7));
        $bank->expects($this->exactly(3))
                ->method('draw')
                ->with($this->equalTo($deck));

        $this->bank = $bank;
        $this->deck = $deck;
        $this->dealBank();

        $this->assertTrue($this->bankPlaying);
    }

    /**
     * Tests the dealBank method, bank picks as long as risk is below 50% but stops when nu cards left in deck
     */
    public function testDealBankNoCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(1, 1, 0));

        $bank = $this->createMock(Player21::class);
        $bank->method('estimateRisk')->will($this->onConsecutiveCalls(0, 0.3, 0.49, 0.5, 0.7));
        $bank->expects($this->exactly(2))
                ->method('draw')
                ->with($this->equalTo($deck));

        $this->bank = $bank;
        $this->deck = $deck;
        $this->dealBank();

        $this->assertTrue($this->bankPlaying);
    }
}
