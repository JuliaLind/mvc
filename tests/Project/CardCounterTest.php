<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardCounter.
 */
class CardCounterTest extends TestCase
{
    /**
     * @var array<Card> $cards
     */
    protected array $cards;
    protected CardCounter $counter;

    protected function setUp(): void
    {
        $card1 = new Card(2, "H");
        $card2 = new Card(14, "S");
        $card3 = new Card(2, "S");
        $card4 = new Card(4, "C");
        $cards = [
            0 => $card1,
            1 => $card2,
            2 => $card3,
            4 => $card4
        ];
        $this->cards = $cards;
        $this->counter = new CardCounter();
    }

    public function testCardCount(): void
    {
        $exp = 4;
        $res = $this->counter->cardCount($this->cards);
        $this->assertEquals($exp, $res);
    }
}
