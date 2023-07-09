<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

use PHPUnit\Framework\TestCase;

class ApiGame3Test extends TestCase
{
    public function testResults(): void
    {
        $factory = $this->createMock(CardFactory::class);
        $cards = [
            "8D","11C","4S","8H","10C","9D","9C","8S","2D","6C",
            "9S","9H","14D","8C","5S","3C","7S","13S","11H","6H",
            "4D","2H","2S","13H","11S","14S","6D","5H","10S","7C",
            "10H","7H","4C","3H","14H","12D","13C","6S","3S","14C",
            "4H","12C","5C","12S","10D","12H","5D","11D","3D","7D",
            "13D", "2C"
        ];
        $factory->method('fullSet')->willReturn($cards);
        $deck = new Deck($factory);

        $results = [
            "rows" => [
                0 => ["name" => "One Pair","points" => 2],
                1 => ["name" => "Two Pairs","points" => 5],
                2 => ["name" => "Four Of A Kind","points" => 50],
                3 => ["name" => "Full House","points" => 25],
                4 => ["name" => "One Pair","points" => 2]
            ],
            "cols" => [
                0 => ["name" => "None","points" => 0],
                1 => ["name" => "One Pair","points" => 2],
                2 => ["name" => "None","points" => 0],
                3 => ["name" => "Full House","points" => 25],
                4 => ["name" => "None","points" => 0],
            ],
            "total" => 111
        ];

        $rows = [
            ["2C", "14H", "14C", "7H", "6S"],
            ["4C", "10D", "4H", "7C", "10H"],
            ["12C", "12H", "12S", "5C", "12D"],
            ["5H", "3H", "3S", "5D", "3D"],
            ["13C", "10S", "11D", "7D", "13D"]
        ];

        $grid = new Grid();
        $game = new ApiGame3();
        $res = $game->results($deck, $grid);
        $exp = [
            "results" => $results,
            "grid" => $grid,
            "remaining cards" => $deck
        ];

        $this->assertEquals($exp, $res);

        $this->assertEquals(
            $rows,
            $grid ->getRows()
        );

        $this->assertEquals(
            ["8D","11C","4S","8H","10C","9D","9C","8S","2D","6C","9S","9H","14D","8C","5S","3C","7S","13S","11H","6H","4D","2H","2S","13H","11S","14S","6D"],
            $deck->getCards()
        );
    }


}
