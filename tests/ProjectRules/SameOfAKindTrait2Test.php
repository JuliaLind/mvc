<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTrait2Test extends TestCase
{
    use CountByRankTrait;
    use SameOfAKindTrait2;
    use SameOfAKindTrait4;


    public function testPossibleWithoutCardOk(): void
    {
        $this->minCountRank = 2;
        $hand = ["4D", "9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }
}
