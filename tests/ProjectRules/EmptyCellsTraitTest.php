<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class EmptyCellsTraitTest extends TestCase
{
    use EmptyCellsTrait;

    public function testSinglehand(): void
    {
        $hand = [
            1 => "card",
            2 => "card2",
            4 => "card3"
        ];

        $exp = [
            [3, 0],
            [3, 3]
        ];

        $res = $this->singleHand($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingleHand2(): void
    {
        $hand = [
            2 => "card",
            4 => "card2"
        ];

        $exp = [
            [3, 0],
            [3, 1],
            [3, 3]
        ];

        $res = $this->singleHand($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingleHand3(): void
    {
        $hand = [
            0 => "card",
            4 => "card2"
        ];

        $exp = [
            [3, 1],
            [3, 2],
            [3, 3]
        ];

        $res = $this->singleHand($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingleHand4(): void
    {
        $hand = [
            0 => "card",
        ];

        $exp = [
            [3, 1],
            [3, 2],
            [3, 3],
            [3, 4]
        ];

        $res = $this->singleHand($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingleHand5(): void
    {
        $hand = [];

        $exp = [
            [3, 0],
            [3, 1],
            [3, 2],
            [3, 3],
            [3, 4],
        ];

        $res = $this->singleHand($hand, 3);
        $this->assertEquals($exp, $res);
    }
}
