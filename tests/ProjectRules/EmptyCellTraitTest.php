<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class EmptyCellTraitTest extends TestCase
{
    use EmptyCellTrait;

    public function testSingle(): void
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

        $res = $this->single($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingle2(): void
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

        $res = $this->single($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingle3(): void
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

        $res = $this->single($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingle4(): void
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

        $res = $this->single($hand, 3);
        $this->assertEquals($exp, $res);
    }

    public function testSingle5(): void
    {
        $hand = [];

        $exp = [
            [3, 0],
            [3, 1],
            [3, 2],
            [3, 3],
            [3, 4],
        ];

        $res = $this->single($hand, 3);
        $this->assertEquals($exp, $res);
    }
}
