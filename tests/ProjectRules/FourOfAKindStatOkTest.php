<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

/**
 * Test cases for class Royal Flush.
 */
class FourOfAKindStatOkTest extends TestCase
{
    public function testPossibleOk(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk2(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk3(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'),];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk4(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk5(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk6(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(5, 'D'), new Card(14, 'D'), new Card(5, 'C'), new Card(5, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
