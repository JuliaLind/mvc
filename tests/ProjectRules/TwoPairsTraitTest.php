<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTraitTest extends TestCase
{
    use TwoPairsTrait;
    use CountByRankTrait;


    public function testCheck3Ok(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $res = $this->check3($cards);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk(): void
    {
        $cards = ["14H", "11D", "4C", "8C", "14S", "10S", "5C", "9S"];
        $res = $this->check3($cards);
        $this->assertFalse($res);
    }

}
