<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FourOfAKindTest extends TestCase
{
    use CountByRankTrait;

    public function testScoredNotOk(): void
    {
        $rule = new SameOfAKind(4);
        $hand = ["4S", "5S", "8S", "4D", "3H"];
        $res = $rule->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredNotOk2(): void
    {
        $rule = new SameOfAKind(4);
        $hand = ["4S", "5S", "8S", "9D", "3H"];
        $res = $rule->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredNotOk3(): void
    {
        $rule = new SameOfAKind(4);
        $hand = ["4S", "5S", "8S", "4D", "4H"];
        $res = $rule->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredOk(): void
    {
        $rule = new SameOfAKind(4);
        $hand = ["11S", "11C", "8S", "11D", "11H"];
        $res = $rule->scored($hand);
        $this->assertTrue($res);
    }
}
