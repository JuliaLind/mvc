<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTrait3Test extends TestCase
{
    use FlushTrait3;
    use CountBySuitTrait;

    public function testCheckInDeckNotOk2(): void
    {
        $deck = ["8S", "2S", "7H", "3S"];
        $hand = ["5H", "8H", "4H"];
        $this->suit = "H";
        $this->assertFalse($this->checkInDeck($deck, $hand));
    }

    public function testCheckInDeckOk(): void
    {
        $deck = ["8H", "2S", "8H", "3S", "5H", "6H", "7H"];
        $hand = ["4H"];
        $this->suit = "H";
        $this->assertTrue($this->checkInDeck($deck, $hand));
    }

    public function testCheckInDeckOk2(): void
    {
        $deck = ["8H", "2S", "8H", "3S", "5H"];
        $hand = ["4H", "7H"];
        $this->suit = "H";
        $this->assertTrue($this->checkInDeck($deck, $hand));
    }
}
