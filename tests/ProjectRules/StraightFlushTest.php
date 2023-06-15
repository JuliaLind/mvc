<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 6; $rank++) {
            array_push($hand, strval($rank)."D");
        }
        shuffle($hand);
        $rule = new Straight(1);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 5; $rank++) {
            array_push($hand, strval($rank)."D");
        }
        shuffle($hand);
        $rule = new Straight(1);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = [];
        for ($rank = 6; $rank <= 8; $rank++) {
            array_push($hand, strval($rank)."D");
        }
        for ($rank = 9; $rank <= 10; $rank++) {
            array_push($hand, strval($rank)."S");
        }

        shuffle($hand);
        $rule = new Straight(1);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 7; $rank++) {
            array_push($hand, strval($rank)."D");
        }
        unset($hand[3]);
        shuffle($hand);
        $rule = new Straight(1);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk4(): void
    {
        $hand = [];
        for ($rank = 10; $rank <= 14; $rank++) {
            array_push($hand, strval($rank)."D");
        }
        $hand[2] = "5D";
        shuffle($hand);
        $rule = new Straight(1);
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
