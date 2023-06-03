<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

/**
 * Test cases for class Royal Flush.
 */
class FourOfAKindStatNotOkTest extends TestCase
{
    public function testPossibleNotOk(): void
    {
        $counter = $this->createMock(CardCounter::class);
        $counter->expects($this->never())->method('count');

        $rule = new FourOfAKindStat($counter);

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
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk3(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk4(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(10, 'H')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk5(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk6(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S'), new Card(7, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
