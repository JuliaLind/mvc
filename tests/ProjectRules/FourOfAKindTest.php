<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FourOfAKindTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testScoreOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(4, 'C'), new Card(4, 'S')];
        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(4, 'S')];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testScoreNotOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(5, 'S'), new Card(4, 'S')];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }


    public function testScoreNotOk3(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(4, 'S')];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
