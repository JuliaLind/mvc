<?php

namespace App\ProjectCard;

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

    public function testCount(): void
    {
        $exp1 = [
            2 => 2,
            14 => 1,
            4 => 1
        ];

        $exp2 = [
            'H' => 1,
            'S' => 2,
            'C' => 1
        ];
        $res = $this->counter->count($this->cards);
        $this->assertEquals($exp1, $res['ranks']);
        $this->assertEquals($exp2, $res['suits']);
    }
}
