<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class StraightFlushTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 6; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 5; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = [];
        for ($rank = 6; $rank <= 8; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        for ($rank = 9; $rank <= 10; $rank++) {
            array_push($hand, new Card($rank, "S"));
        }

        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 7; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        unset($hand[3]);
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk4(): void
    {
        $hand = [];
        for ($rank = 10; $rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        $hand[2] = new Card(5, "D");
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
