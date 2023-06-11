<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectGrid\Grid;

class RulesTest extends TestCase
{
    public function testCheckWinSingle(): void
    {
        $rules = new Rules();

        $hands= [
            [new Card(14, 'D'), new Card(14, 'C'), new Card(14, 'S'), new Card(5, 'C'), new Card(10, 'H')],
            [new Card(10, 'D'), new Card(8, 'C'), new Card(8, 'D'), new Card(5, 'D'), new Card(6, 'H')],
            [new Card(12, 'D'), new Card(3, 'C'), new Card(2, 'C'), new Card(5, 'S'), new Card(7, 'H')],
            [new Card(13, 'D'), new Card(4, 'C'), new Card(9, 'C'), new Card(5, 'H'), new Card(8, 'H')],
            [new Card(11, 'D'), new Card(7, 'C'), new Card(10, 'H'), new Card(8, 'S'), new Card(9, 'H')],
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
        ];


        $exp = [[
                    'name' => 'Three Of A Kind',
                    'points' => 10
                ],
                [
                    'name' => 'One Pair',
                    'points' => 2
                ],
                [
                    'name' => 'None',
                    'points' => 0
                ],
                [
                    'name' => 'None',
                    'points' => 0
                ],
                [
                    'name' => 'Straight',
                    'points' => 15
                ],
                [
                    'name' => 'Royal Flush',
                    'points' => 100
                ],
                [
                    'name' => 'Flush',
                    'points' => 20
                ],
                [
                    'name' => 'None',
                    'points' => 0
                ],
                [
                    'name' => 'Four Of A Kind',
                    'points' => 50
                ],
                [
                    'name' => 'Straight Flush',
                    'points' => 75
                ],
            ];

        for ($i = 0; $i < 10; $i ++) {
            $res = $rules->checkHandForWin($hands[$i]);
            $this->assertEquals($exp[$i], $res);
        }
    }

    public function testSetGetRules(): void
    {
        $rules = new Rules();
        $scored = $this->createMock(RoyalFlush::class);
        $allRules = [
            [
                'name' => 'Test1',
                'points' => 150,
                'scored' => $scored
            ]
        ];
        $rules->setRules($allRules);

        $res = $rules->getRules();
        $this->assertEquals($allRules, $res);
    }
}
