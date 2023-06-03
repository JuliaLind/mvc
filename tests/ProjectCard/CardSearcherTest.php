<?php

namespace App\ProjectCard;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardSearcher.
 */
class CardSearcherTest extends TestCase
{
    public function testSearch(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();

        $res = $searcher->search($cards, 7, "D");
        $this->assertTrue($res);

        $res = $searcher->search($cards, 8, "D");
        $this->assertFalse($res);

        $res = $searcher->search($cards, 7, "C");
        $this->assertFalse($res);

        $res = $searcher->search($cards, 12, "D");
        $this->assertTrue($res);

        $res = $searcher->search($cards, 14, "D");
        $this->assertFalse($res);
    }
}
