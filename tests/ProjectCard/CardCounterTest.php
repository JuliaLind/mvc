<?php

namespace App\ProjectCard;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardCounter.
 */
class CardCounterTest extends TestCase
{
    /**
     * @var array<string> $cards
     */
    protected array $cards;
    protected CardCounter $counter;

    protected function setUp(): void
    {
        $cards = [
            0 => "2H",
            1 => "14S",
            2 => "2S",
            4 => "4C"
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
