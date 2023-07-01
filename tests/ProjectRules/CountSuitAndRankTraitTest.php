<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class CountSuitAndRankTraitTest extends TestCase
{
    use CountSuitAndRankTrait;

    public function testCountSuitAndRank(): void
    {
        $cards = [];
        $res = $this->countSuitAndRank($cards);
        $exp = [
            'ranks' => [],
            'suits' => [],
        ];
        $this->assertEquals($exp, $res);
    }

    public function testCountSuitAndRank2(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $exp = [
            'ranks' => [
                4 => 1,
                5 => 1,
                8 => 3,
                10 => 1,
                14 => 2,
            ],
            'suits' => [
                "H" => 1,
                "D" => 1,
                "C" => 3,
                "S" => 3
            ],
        ];
        $res = $this->countSuitAndRank($cards);
        $this->assertEquals($exp, $res);
    }
}
