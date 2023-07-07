<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FinalResultsTraitTest extends TestCase
{
    use FinalResultsTrait;

    protected function setUp(): void
    {
        $this->rules = [
            new RoyalFlush(),
            new StraightFlush(),
            new SameOfAKind(4),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
    }

    public function testResultsOneDirection(): void
    {
        $hands = [
            0 => [
                0 => "8H",
                1 => "7H",
                2 => "6H",
                3 => "5H",
                4 => "9H"
            ],
            1 => [
                0 => "9S",
                1 => "6D",
                2 => "6S",
                3 => "3D",
                4 => "7D"
            ],
            2 => [
                0 => "11D",
                1 => "9D",
                2 => "5D",
                3 => "4S",
                4 => "7C"
            ],
            3 => [
                0 => "2D",
                1 => "5C",
                2 => "2C",
                3 => "2S",
                4 => "2H"
            ],
            4 => [
                0 => "13C",
                1 => "14S",
                2 => "10H",
                3 => "11C",
                4 => "12H"
            ]
        ];
        $res = $this->resultsOneDirection($hands);
        $total = 75 + 2 + 50 + 15;
        $exp = [
            'data' => [
                0 => [
                    "name" => "Straight Flush",
                    "points" => 75
                  ],
                  1 => [
                    "name" => "One Pair",
                    "points" => 2
                  ],
                  2 => [
                    "name" => "None",
                    "points" => 0
                  ],
                  3 => [
                    "name" => "Four Of A Kind",
                    "points" => 50
                  ],
                  4 => [
                    "name" => "Straight",
                    "points" => 15
                  ]
            ],
            'total' => $total
        ];
        $this->assertEquals($exp, $res);
    }
}
