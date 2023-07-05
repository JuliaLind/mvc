<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait4Test extends TestCase
{
    use FullHouseTrait4;


    public function testCheck3Ok(): void
    {
        $ranksHand = [
            4 => 2,
            10 => 1
        ];

        $ranksAll = [
            4 => 3,
            10 => 2,
            11 => 1
        ];

        $res = $this->check3($ranksHand, $ranksAll);
        $this->assertTrue($res);
    }


    public function testCheck3Ok3(): void
    {
        $ranksHand = [
            4 => 1,
            10 => 1
        ];

        $ranksAll = [
            4 => 2,
            5 => 1,
            10 => 3,
            11 => 1
        ];

        $res = $this->check3($ranksHand, $ranksAll);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk(): void
    {
        $ranksHand = [
            4 => 2,
        ];

        $ranksAll = [
            4 => 2,
            10 => 2,
            11 => 1
        ];

        $res = $this->check3($ranksHand, $ranksAll);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk2(): void
    {
        $ranksHand = [
            4 => 2,
            3 => 1
        ];

        $ranksAll = [
            3 => 1,
            4 => 3,
            10 => 3,
            11 => 1
        ];

        $res = $this->check3($ranksHand, $ranksAll);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk3(): void
    {
        $ranksHand = [
            4 => 3,
        ];

        $ranksAll = [
            4 => 3,
            10 => 2,
            11 => 1
        ];

        $res = $this->check3($ranksHand, $ranksAll);
        $this->assertFalse($res);
    }

}
