<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FourOfAKindTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = ["4D", "4H", "5H", "4C", "4S"];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testScoreOk2(): void
    {
        $hand = ["4D", "4H", "4C", "4S"];
        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = ["4D", "4H", "5C", "4S"];
        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testScoreNotOk2(): void
    {
        $hand = ["4D", "4H", "5C", "5S", "4S"];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }


    public function testScoreNotOk3(): void
    {
        $hand = ["4D", "4H", "4S"];

        $rule = new SameOfAKind(4);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
