<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\CardCounter;

class SameRankTraitTest extends TestCase
{
    use SameRankTrait;


    protected function setUp(): void
    {
        $this->cardCounter= new CardCounter();
        $this->minCountRank = 2;
    }

    public function testCheckOk(): void
    {
        $hand = ["5S", "8C", "5D"];
        $res = $this->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testCheckNotOk(): void
    {
        $hand = ["7S", "8C", "5D"];
        $res = $this->check($hand);
        $exp = false;
        $this->assertEquals($exp, $res);
    }
}
