<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait6Test extends TestCase
{
    use TwoPairsTrait6;
    use TwoPairsTrait8;

    // /**
    //  * Some attributes to remove dependency to the
    //  * actual matchOneInDeck method
    //  */
    // /**
    //  * @var array<int,int> $arg1
    //  */
    // private array $arg1 = [];
    // /**
    //  * @var array<int,int> $arg2
    //  */
    // private array $arg2 = [];
    // private bool $returnMockedMethod = false;

    // /**
    //  * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
    //  * "mock" method from TwoPairstrait8 to remove dependecy in testing
    //  * @param array<int,int> $ranksHand
    //  * @param array<int,int> $ranksDeck
    //  */
    // private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool
    // {
    //     $this->arg1 = $ranksHand;
    //     $this->arg2 = $ranksDeck;
    //     return $this->returnMockedMethod;
    // }


    public function testCheck3Ok(): void
    {
        $rank = 4;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            8 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk(): void
    {
        $rank = 3;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            8 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk2(): void
    {
        $rank = 4;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            5 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
