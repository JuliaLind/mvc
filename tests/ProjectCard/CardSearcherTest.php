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

    // public function testSearchForRankOk(): void
    // {
    //     $cards = [
    //         new Card(5, "S"),
    //         new Card(7, "D"),
    //         new Card(12, "C"),
    //         new Card(12, "D")
    //     ];
    //     $searcher = new CardSearcher();
    //     $res = $searcher->searchForRank($cards, 12);
    //     $exp = 2;
    //     $this->assertEquals($exp, $res);
    // }

    // public function testSearchForRankNotOk(): void
    // {
    //     $cards = [
    //         new Card(5, "S"),
    //         new Card(7, "D"),
    //         new Card(12, "C"),
    //         new Card(12, "D")
    //     ];
    //     $searcher = new CardSearcher();
    //     $res = $searcher->searchForRank($cards, 11);
    //     $exp = 0;
    //     $this->assertEquals($exp, $res);
    // }

    public function testCheckRankQuantNotOk(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 4);
        $this->assertFalse($res);
    }

    public function testCheckRankQuantOk(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 2);
        $this->assertTrue($res);
    }

    public function testCheckRankQuantOk2(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(12, "H"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRankQuant($cards, 12, 2);
        $this->assertTrue($res);
    }

    public function testCheckRanksQuantNotOk(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(12, "H"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [13, 4], 2);
        $this->assertFalse($res);
    }

    public function testCheckRanksQuantOk(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(12, "H"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [12, 4], 3);
        $this->assertTrue($res);
    }

    public function testCheckRanksQuantOk2(): void
    {
        $cards = [
            new Card(5, "S"),
            new Card(12, "H"),
            new Card(7, "D"),
            new Card(12, "C"),
            new Card(12, "D")
        ];
        $searcher = new CardSearcher();
        $res = $searcher->checkRanksQuant($cards, [4, 12], 3);
        $this->assertTrue($res);
    }

    public function testCheckRankQuantOk3(): void
    {
        $cards = [
            new Card(10, 'D'), new Card(11, 'D'), new Card(13, 'D'), new Card(9, 'C'), new Card(8, 'C'), new Card(12, 'D')
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
