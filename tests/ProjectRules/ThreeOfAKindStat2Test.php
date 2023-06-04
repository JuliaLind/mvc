<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class ThreeOfAKindStat2Test extends TestCase
{
    public function testPossibleNotOk(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(2, 'C')];

        $deck = [new Card(4, 'S'), new Card(4, 'H')];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleOk2(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(5, 'S')];

        $deck = [new Card(2, 'D'), new Card(4, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk3(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [new Card(4, 'C')];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleNotOk2(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(5, 'C'), new Card(5, 'H'), new Card(4, 'S'), new Card(4, 'D'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleOk5(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D')];

        $deck = [new Card(4, 'S'), new Card(4, 'C'), new Card(5, 'C')];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk6(): void
    {
        $rule = new ThreeOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D'), new Card(8, 'C')];

        $deck = [new Card(4, 'S'), new Card(5, 'C')];
        $card = new Card(4, 'C');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
