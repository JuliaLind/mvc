<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

/**
 * Test cases for class Royal Flush.
 */
class StraightFlushTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 6; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Straight Flush",
            'points' => 75,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 5; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk2(): void
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
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk3(): void
    {
        $hand = [];
        for ($rank = 2; $rank <= 7; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        unset($hand[3]);
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk4(): void
    {
        $hand = [];
        for ($rank = 10; $rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        $hand[2] = new Card(5, "D");
        shuffle($hand);
        $rule = new StraightFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }
}
