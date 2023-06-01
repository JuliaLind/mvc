<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Counter.
 */
class CounterTest extends TestCase
{
    /**
     * @var array<Card> $cards
     */
    protected array $cards;
    protected Counter $counter;

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
        $this->counter = new Counter();
    }

    public function testCardCount(): void
    {
        $exp = 4;
        $res = $this->counter->cardCount($this->cards);
        $this->assertEquals($exp, $res);
    }

    public function testValues(): void
    {
        $exp = [
            2 => 2,
            14 => 1,
            4 => 1
        ];
        $res = $this->counter->values($this->cards);
        $this->assertEquals($exp, $res);
    }

    public function testSuits(): void
    {
        $exp = [
            'H' => 1,
            'S' => 2,
            'C' => 1
        ];
        $res = $this->counter->suits($this->cards);
        $this->assertEquals($exp, $res);
    }
}
