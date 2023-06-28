<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

use App\Cards\DeckOfCards;

/**
 * Test cases for trait BettingGameTrait.
 */
class DealBankEasyTraitTest extends TestCase
{
    use DealBankEasyTrait;

    /**
     * Tests the dealBank method stops dealing when
     * value in hand is 17 pr above
     */
    public function testDealBankCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);


        $bank = $this->createMock(Player21::class);
        $bank->method('handValue')->will($this->onConsecutiveCalls(0, 10, 16, 17, 19));

        $bank->expects($this->exactly(3))
                ->method('draw')
                ->with($this->equalTo($deck));

        $this->bank = $bank;
        $this->deck = $deck;

        $this->dealBank();
        $this->assertTrue($this->bankPlaying);
    }

    /**
     * Tests that dealBank method stops dealing when no
     * cards left
     */
    public function testDealBankNoCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $bank = $this->createMock(Player21::class);
        $bank->method('handValue')->willReturn(10);
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(1, 0));
        $bank->expects($this->once())
                ->method('draw')
                ->with($this->equalTo($deck));

        $this->bank = $bank;
        $this->deck = $deck;
        $this->dealBank();
    }
}
