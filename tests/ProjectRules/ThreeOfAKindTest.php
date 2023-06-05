<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class ThreeOfAKindTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'H'), new Card(4, 'C'), new Card(8, 'S')];

        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(4, 'S')];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(9, 'S')];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(5, 'S'), new Card(9, 'S')];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
