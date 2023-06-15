<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;

class RulesTest extends TestCase
{
    public function testCheckWinSingle(): void
    {
        $rules = new Rules();

        $hands= [
            ["14D", "14C", "14S", "5C", "10H"],
            ["10D", "8C", "8D", "5D", "6H"],
            ["12D", "3C", "2C", "5S", "7H"],
            ["13D", "4C", "9C", "5H", "8H"],
            ["11D", "7C", "10H", "8S", "9H"],
            [ "14D", "10D", "12D", "13D", "11D"],
            ["14C", "8C", "3C", "4C", "7C"],
            ["14S", "8D", "2C", "9C", "10H"],
            ["5C", "5D", "5S", "5H", "8S"],
            ["10H", "6H", "7H", "8H", "9H"],
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
