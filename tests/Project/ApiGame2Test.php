<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

use PHPUnit\Framework\TestCase;

class ApiGame2Test extends TestCase
{
    public function testOneRound(): void
    {
        $factory = $this->createMock(CardFactory::class);
        $cards = ["12S","3D","2D","13S","6C","9H","4C","8D","3C","10C","11C","13C","10S","5D","8C","5S","6S","6D","3H","3S","13H","14S","14C","5C","2H","4S","12C","4D","5H","8H","9C","13D","9S","4H","12D","11S","14D","7S","11D","10D","14H","10H","8S","9D","2C", "7C"];
        $factory->method('fullSet')->willReturn($cards);
        $deck = new Deck($factory);

        $grid = new Grid();
        $row = 3;
        $col = 2;

        $game = new ApiGame2();
        $res = $game->oneRound($row, $col, $grid, $deck);
        $exp = [
            "placement" => "You placed card '7C' on row 3 column 2",
            "grid" => $grid,
            "remaining cards" => $deck
        ];

        $this->assertEquals($exp, $res);

        $this->assertEquals(
            [
                3 => [2 => "7C"]
            ],
            $grid ->getRows()
        );

        $this->assertEquals(
            ["12S","3D","2D","13S","6C","9H","4C","8D","3C","10C","11C","13C","10S","5D","8C","5S","6S","6D","3H","3S","13H","14S","14C","5C","2H","4S","12C","4D","5H","8H","9C","13D","9S","4H","12D","11S","14D","7S","11D","10D","14H","10H","8S","9D","2C"],
            $deck->getCards()
        );
    }


}
