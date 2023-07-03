<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait2pt2Test extends TestCase
{
    use CountByRankTrait;
    use TwoPairsTrait2;
    use TwoPairsTrait3;
    use TwoPairsTrait7;
    use TwoPairsTrait8;
    use TwoPairsTrait9;
    use TwoPairsTrait10;

    use TwoPairsTrait11;
    use TwoPairsTrait12;
    use TwoPairsTrait13;
    use TwoPairsTrait14;


    public function testPossibleWithoutCardOk(): void
    {
        $deck = ["4C", "5C", "8S"];
        $hand = ["8C", "14S", "14H", "10S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk(): void
    {
        $deck = ["4C", "8S", "8C"];
        $hand = ["14S", "14H", "10S", "5C"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
