<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait3Test extends TestCase
{
    use FullHouseTrait3;
    use CountByRankTrait;


    public function testPossibleDeckOnlyOk(): void
    {
        $deck = ["4H", "4C", "4D", "10H", "10C", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }


    public function testPossibleDeckOnlyOk3(): void
    {
        $deck = ["4H", "4C", "5D", "10H", "10C", "10S", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }

    public function testPossibleDeckOnlyNotOk(): void
    {
        $deck = ["4H", "4C", "10H", "10C", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }


    public function testPossibleDeckOnlyNotOk2(): void
    {
        $deck = ["4H", "10D", "10H", "10C", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyNotOk3(): void
    {
        $deck = ["4H", "10D", "10H", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyNotOk4(): void
    {
        $deck = ["4H", "4C", "10H", "12C", "11S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyOk5(): void
    {
        $deck = ["4H", "4C", "3C", "10H", "4D", "10C", "11S", "10S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }

    public function testPossibleDeckOnlyOk4(): void
    {
        $deck = ["4H", "4C", "10H", "4D", "11S", "10S"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }

}
