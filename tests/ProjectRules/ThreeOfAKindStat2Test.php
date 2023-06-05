<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class ThreeOfAKindStat2Test extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [new Card(4, 'D'), new Card(2, 'C')];

        $deck = [new Card(4, 'S'), new Card(4, 'H')];
        $card = new Card(5, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk2(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(5, 'S')];

        $deck = [new Card(2, 'D'), new Card(4, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk3(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [new Card(4, 'C')];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(5, 'C'), new Card(5, 'H'), new Card(4, 'S'), new Card(4, 'D'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk5(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D')];

        $deck = [new Card(4, 'S'), new Card(4, 'C'), new Card(5, 'C')];
        $card = new Card(5, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk6(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D'), new Card(8, 'C')];

        $deck = [new Card(4, 'S'), new Card(5, 'C')];
        $card = new Card(4, 'C');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
