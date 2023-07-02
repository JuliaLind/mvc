<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait3Test extends TestCase
{
    use TwoPairsTrait3;
    use CountByRankTrait;


    public function testCheck3Ok(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $res = $this->possibleDeckOnly($cards);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk(): void
    {
        $cards = ["14H", "11D", "4C", "8C", "14S", "10S", "5C", "9S"];
        $res = $this->possibleDeckOnly($cards);
        $this->assertFalse($res);
    }

}
