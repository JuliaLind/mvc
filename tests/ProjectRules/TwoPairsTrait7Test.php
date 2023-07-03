<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait7Test extends TestCase
{
    use TwoPairsTrait7;

    /**
     * Some attributes to remove dependency to the
     * actual threeCardsTwoPairs method
     */
    /**
     * @var array<int,int> $arg1
     */
    private array $arg1 = [];
    /**
     * @var array<int,int> $arg2
     */
    private array $arg2 = [];
    private bool $returnMockedMethod = false;

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * "mock" method from TwoPairstrait14 to remove dependecy in testing
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function threeCardsTwoPairs(array $ranksHand, array $ranksDeck): bool
    {
        $this->arg1 = $ranksHand;
        $this->arg2 = $ranksDeck;
        return $this->returnMockedMethod;
    }

    public function testFourCardsTwoPairsOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 2,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertTrue($res);
    }

    public function testFourCardsTwoPairsNotOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertFalse($res);
    }

    public function testFindSecondPairOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals([], $this->arg1);
        $this->assertEquals([], $this->arg2);
    }

    public function testFindSecondPairOk2(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $this->returnMockedMethod = true;

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals($ranksHand, $this->arg1);
        $this->assertEquals($ranksDeck, $this->arg2);
    }

    public function testFindSecondPairOk3(): void
    {
        $ranksHand = [
            4 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $this->returnMockedMethod = true;

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals($ranksHand, $this->arg1);
        $this->assertEquals($ranksDeck, $this->arg2);
    }

    public function testFindSecondPairOk4(): void
    {
        $ranksHand = [
            4 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertFalse($res);
        $this->assertEquals($ranksHand, $this->arg1);
        $this->assertEquals($ranksDeck, $this->arg2);
    }
}
