<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class ThreeOfAKindTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = ["4D", "4H", "5H", "4C", "8S"];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckOk2(): void
    {
        $hand = ["4D", "4C", "4S"];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = ["4D", "4H", "5C", "9S"];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = ["4D", "4H", "5C", "5S", "9S"];
        $rule = new SameOfAKind(3);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
