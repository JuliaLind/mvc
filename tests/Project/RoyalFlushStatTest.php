<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Royal Flush.
 */
class RoyalFlushStatTest extends TestCase
{
    public function testPossibleNotOk(): void
    {
        $counter = $this->createMock(CardCounter::class);
        $counter->expects($this->never())->method('count');

        $rule = new RoyalFlushStat($counter);

        $deck = [$this->createMock(Card::class)];
        $card = $this->createMock(Card::class);
        $hand = [];
        for ($i = 0; $i < 5; $i++) {
            array_push($hand, $this->createMock(Card::class));
        }
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk2(): void
    {
        $counter = $this->createMock(CardCounter::class);
        $counter->method('count')->willReturn([
            'ranks' => [
                10 => 1,
                11 => 1,
                13 => 1,
                14 => 1
            ],
            'suits' => [
                'D' => 3,
                'H' => 1
            ]
        ]);

        $rule = new RoyalFlushStat($counter);

        $deck = [$this->createMock(Card::class)];
        $card = $this->createMock(Card::class);
        $hand = [];
        for ($i = 0; $i < 4; $i++) {
            array_push($hand, $this->createMock(Card::class));
        }
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk3(): void
    {
        $counter = $this->createMock(CardCounter::class);
        $counter->method('count')->willReturn([
            'ranks' => [
                10 => 1,
                11 => 1,
                13 => 1,
                14 => 1
            ],
            'suits' => [
                'D' => 4,
            ]
        ]);


        $deck = [$this->createMock(Card::class)];
        $card = $this->createMock(Card::class);
        $hand = [];
        for ($i = 0; $i < 3; $i++) {
            array_push($hand, $this->createMock(Card::class));
        }
        $searcher = $this->createMock(CardSearcher::class);
        $searcher->expects($this->exactly(3))->method('search')
        ->will($this->onConsecutiveCalls(true, true, false));

        $rule = new RoyalFlushStat($counter, $searcher);
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk4(): void
    {
        $counter = $this->createMock(CardCounter::class);
        $counter->method('count')->willReturn([
            'ranks' => [
                10 => 1,
                11 => 1,
                12 => 1,
                13 => 1
            ],
            'suits' => [
                'D' => 4,
            ]
        ]);



        $deck = [$this->createMock(Card::class)];
        $card = $this->createMock(Card::class);
        $hand = [];
        for ($i = 0; $i < 3; $i++) {
            array_push($hand, $this->createMock(Card::class));
        }
        $searcher = $this->createMock(CardSearcher::class);
        $searcher->expects($this->exactly(4))->method('search')
        ->will($this->onConsecutiveCalls(true, true, true, false));
        $rule = new RoyalFlushStat($counter, $searcher);
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk5(): void
    {
        $ten = new Card(10, "D");
        $jack = new Card(11, "H");
        $queen = new Card(12, "D");
        $king = new Card(13, "D");
        $ace = new Card(14, "D");

        $hand = [$ten, $queen, $king];
        $deck = [$jack];
        $card = $ace;

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleOk(): void
    {
        $ten = new Card(10, "D");
        $jack = new Card(11, "D");
        $queen = new Card(12, "D");
        $king = new Card(13, "D");
        $ace = new Card(14, "D");

        $hand = [$ten, $queen, $king];
        $deck = [$jack];
        $card = $ace;

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk2(): void
    {
        $ten = new Card(10, "D");
        $jack = new Card(11, "D");
        $queen = new Card(12, "D");
        $king = new Card(13, "D");
        $ace = new Card(14, "D");

        $hand = [];
        $deck = [$ten, $queen, $king, $jack];
        $card = $ace;

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
