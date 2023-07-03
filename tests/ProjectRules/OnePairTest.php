<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class OnePairTest extends TestCase
{
    use CountByRankTrait;

    public function testScoredOk(): void
    {
        $rule = new SameOfAKind(2);
        $hand = ["4S", "5S", "8S", "4D", "3H"];
        $res = $rule->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredNotOk(): void
    {
        $rule = new SameOfAKind(2);
        $hand = ["4S", "5S", "8S", "9D", "3H"];
        $res = $rule->scored($hand);
        $this->assertFalse($res);
    }
}
