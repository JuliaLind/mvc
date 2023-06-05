<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

/**
 * Test cases for class Royal Flush.
 */
class RoyalFlushTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new RoyalFlush();
        $this->assertInstanceOf("\App\ProjectRules\RoyalFlush", $rule);
    }

    public function testCheckOk(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->check($hand);
        // $exp = [
        //     'name' => "Royal Flush",
        //     'points' => 100,
        //     'scored' => true
        // ];
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [];
        for ($rank = 9 ;$rank <= 13; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
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
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        unset($hand[2]);
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk4(): void
    {
        $hand = [];
        for ($rank = 10 ;$rank <= 14; $rank++) {
            array_push($hand, new Card($rank, "D"));
        }
        $hand[2] = new Card(5, "D");
        shuffle($hand);
        $rule = new RoyalFlush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
