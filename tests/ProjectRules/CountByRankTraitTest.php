<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class CountByRankTraitTest extends TestCase
{
    use CountByRankTrait;

    public function testCountByRank(): void
    {
        $cards = [];
        $res = $this->countByRank($cards);
        $this->assertEquals([], $res);
    }

    public function testCountByRank2(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $exp = [
            4 => 1,
            5 => 1,
            8 => 3,
            10 => 1,
            14 => 2,
        ];
        $res = $this->countByRank($cards);
        $this->assertEquals($exp, $res);
    }
}
