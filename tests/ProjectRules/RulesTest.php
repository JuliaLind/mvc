<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectGrid\Grid;

class RulesTest extends TestCase
{
    public function testCheckForWin(): void
    {
        $rules = new Rules();

        // $cards = [
        //     [new Card(14, 'D'), new Card(14, 'C'), new Card(14, 'S'), new Card(5, 'C'), new Card(10, 'H')],
        //     [new Card(10, 'D'), new Card(8, 'C'), new Card(8, 'D'), new Card(5, 'D'), new Card(6, 'H')],
        //     [new Card(12, 'D'), new Card(3, 'C'), new Card(2, 'C'), new Card(5, 'S'), new Card(7, 'H')],
        //     [new Card(13, 'D'), new Card(4, 'C'), new Card(9, 'C'), new Card(5, 'H'), new Card(8, 'H')],
        //     [new Card(11, 'D'), new Card(7, 'C'), new Card(10, 'H'), new Card(8, 'S'), new Card(9, 'H')]
        // ];

        // $grid = new Grid();
        // $grid->setCards($cards);

        $cards = [ 'rows' => [
            [new Card(14, 'D'), new Card(14, 'C'), new Card(14, 'S'), new Card(5, 'C'), new Card(10, 'H')],
            [new Card(10, 'D'), new Card(8, 'C'), new Card(8, 'D'), new Card(5, 'D'), new Card(6, 'H')],
            [new Card(12, 'D'), new Card(3, 'C'), new Card(2, 'C'), new Card(5, 'S'), new Card(7, 'H')],
            [new Card(13, 'D'), new Card(4, 'C'), new Card(9, 'C'), new Card(5, 'H'), new Card(8, 'H')],
            [new Card(11, 'D'), new Card(7, 'C'), new Card(10, 'H'), new Card(8, 'S'), new Card(9, 'H')]
        ],
        'cols' => [
            [
                new Card(14, 'D'), new Card(10, 'D'), new Card(12, 'D'), new Card(13, 'D'), new Card(11, 'D')
            ],
            [
                new Card(14, 'C'), new Card(8, 'C'), new Card(3, 'C'), new Card(4, 'C'), new Card(7, 'C')
            ],
            [
                new Card(14, 'S'), new Card(8, 'D'), new Card(2, 'C'), new Card(9, 'C'), new Card(10, 'H')
            ],
            [
                new Card(5, 'C'), new Card(5, 'D'), new Card(5, 'S'), new Card(5, 'H'), new Card(8, 'S')
            ],
            [
                new Card(10, 'H'), new Card(6, 'H'), new Card(7, 'H'), new Card(8, 'H'), new Card(9, 'H')
            ],
        ]
    ];

        $exp = [
            'rows' => [
                0 => [
                    'name' => 'Three Of A Kind',
                    'points' => 10
                ],
                1 => [
                    'name' => 'One Pair',
                    'points' => 2
                ],
                2 => [
                    'name' => 'None',
                    'points' => 0
                ],
                3 => [
                    'name' => 'None',
                    'points' => 0
                ],
                4 => [
                    'name' => 'Straight',
                    'points' => 15
                ],
            ],
            'cols' => [
                0 => [
                    'name' => 'Royal Flush',
                    'points' => 100
                ],
                1 => [
                    'name' => 'Flush',
                    'points' => 20
                ],
                2 => [
                    'name' => 'None',
                    'points' => 0
                ],
                3 => [
                    'name' => 'Four Of A Kind',
                    'points' => 50
                ],
                4 => [
                    'name' => 'Straight Flush',
                    'points' => 75
                ],
            ],
            'total' => (10+2+15+100+20+50+75)
        ];

        // $hands = $grid->rowsAndCols();
        $res = $rules->checkForWin($cards);

        $this->assertEquals($exp, $res);
    }
}
