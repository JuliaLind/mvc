<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectCard\CardCounter;

class SameRankTraitTest extends TestCase
{
    use SameRankTrait;


    protected function setUp(): void
    {
        $this->cardCounter= new CardCounter();
        $this->minCountRank = 2;
        // $this->points = 5;
        // $this->name = "Test Rule";
    }

    public function testCheckOk(): void
    {
        $hand = [new Card(5, 'S'), new Card(8, 'C'), new Card(5, 'D')];
        $res = $this->check($hand);
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [new Card(7, 'S'), new Card(8, 'C'), new Card(5, 'D')];
        $res = $this->check($hand);
        $exp = false;
        $this->assertEquals($exp, $res);
    }
}
