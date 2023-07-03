<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTrait4Test extends TestCase
{
    use SameOfAKindTrait4;

    public function testEnoughSpaceInHandOk(): void
    {
        $this->minCountRank = 2;
        $countHand = 3;
        $countRank = 0;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }

    public function testEnoughSpaceInHandOk2(): void
    {
        $this->minCountRank = 2;
        $countHand = 3;
        $countRank = 1;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }

    public function testEnoughSpaceInHandNotOk(): void
    {
        $this->minCountRank = 2;
        $countHand = 4;
        $countRank = 0;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertFalse($res);
    }

    public function testEnoughSpaceInHandNotOk2(): void
    {
        $this->minCountRank = 3;
        $countHand = 3;
        $countRank = 0;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertFalse($res);
    }

    public function testEnoughSpaceInHandOk3(): void
    {
        $this->minCountRank = 3;
        $countHand = 3;
        $countRank = 1;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }

    public function testEnoughSpaceInHandOk4(): void
    {
        $this->minCountRank = 3;
        $countHand = 4;
        $countRank = 2;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }

    public function testEnoughSpaceInHandOk5(): void
    {
        $this->minCountRank = 4;
        $countHand = 4;
        $countRank = 3;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }

    public function testEnoughSpaceInHandNotOk3(): void
    {
        $this->minCountRank = 4;
        $countHand = 4;
        $countRank = 2;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertFalse($res);
    }

    public function testEnoughSpaceInHandOk6(): void
    {
        $this->minCountRank = 4;
        $countHand = 0;
        $countRank = 1;
        $res = $this->enoughSpaceInHand($countHand, $countRank);
        $this->assertTrue($res);
    }
}
