<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Royal Flush.
 */
class RoyalFlushTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new RoyalFlush();
        $this->assertInstanceOf("\App\Project\RoyalFlush", $rule);

        // $res = $rule->getPoints();
        // $exp = 100;
        // $this->assertEquals($exp, $res);

        // $res = $rule->getName();
        // $exp = "Royal Flush";
        // $this->assertEquals($exp, $res);
    }

    public function testScoreOk(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Royal Flush",
            'points' => 100,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = [];
        for ($rank = 9 ;$rank <= 13; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk2(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 12; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        for ($rank = 13 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "S"));
        }

        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk3(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        unset($hand[2]);
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk4(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        $hand[2] = new Card(5, "D");
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }
}
