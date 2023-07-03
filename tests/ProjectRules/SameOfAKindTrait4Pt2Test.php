<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTrait4Pt2Test extends TestCase
{
    use SameOfAKindTrait4;

    public function testRequiredCountOk(): void
    {
        $this->minCountRank = 2;
        $rankCount = 2;
        $res = $this->requiredCount($rankCount);
        $this->assertTrue($res);
    }

    public function testRequiredCountNotOk(): void
    {
        $this->minCountRank = 3;
        $rankCount = 2;
        $res = $this->requiredCount($rankCount);
        $this->assertFalse($res);
    }

    public function testRequiredCountOk2(): void
    {
        $this->minCountRank = 3;
        $rankCount = 3;
        $res = $this->requiredCount($rankCount);
        $this->assertTrue($res);
    }

    public function testRequiredCountNotOk3(): void
    {
        $this->minCountRank = 4;
        $rankCount = 3;
        $res = $this->requiredCount($rankCount);
        $this->assertFalse($res);
    }

    public function testRequiredCountOk3(): void
    {
        $this->minCountRank = 4;
        $rankCount = 4;
        $res = $this->requiredCount($rankCount);
        $this->assertTrue($res);
    }

    public function testRequiredCountNotOk4(): void
    {
        $this->minCountRank = 2;
        $rankCount = 1;
        $res = $this->requiredCount($rankCount);
        $this->assertFalse($res);
    }
}
