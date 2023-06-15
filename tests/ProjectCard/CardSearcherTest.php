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
            "5S",
            "7D",
            "12C",
            "12D"
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


    public function testCheckRankQuantNotOk(): void
    {
        $cards = [
            "5S",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 4);
        $this->assertFalse($res);
    }

    public function testCheckRankQuantOk(): void
    {
        $cards = [
            "5S",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 2);
        $this->assertTrue($res);
    }

    public function testCheckRankQuantOk2(): void
    {
        $cards = [
            "5S",
            "12H",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 2);
        $this->assertTrue($res);
    }

    public function testCheckRanksQuantNotOk(): void
    {
        $cards = [
            "5S",
            "12H",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [13, 4], 2);
        $this->assertFalse($res);
    }

    public function testCheckRanksQuantOk(): void
    {
        $cards = [
            "5S",
            "12H",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [12, 4], 3);
        $this->assertTrue($res);
    }

    public function testCheckRanksQuantOk2(): void
    {
        $cards = [
            "5S",
            "12H",
            "7D",
            "12C",
            "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [4, 12], 3);
        $this->assertTrue($res);
    }

    public function testCheckRankQuantOk3(): void
    {
        $cards = [
            "10D", "11D", "13D", "9C", "8C", "12D"
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 9, 1);
        $this->assertTrue($res);
        $res = $searcher->checkRankQuant($cards, 10, 1);
        $this->assertTrue($res);
        $res = $searcher->checkRankQuant($cards, 11, 1);
        $this->assertTrue($res);
        $res = $searcher->checkRankQuant($cards, 12, 1);
        $this->assertTrue($res);
        $res = $searcher->checkRankQuant($cards, 13, 1);
        $this->assertTrue($res);
    }
}
