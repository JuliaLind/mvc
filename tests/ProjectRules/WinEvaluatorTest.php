<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectGrid\Grid;

class WinEvaluatorTest extends TestCase
{
    public function testCheckForWin(): void
    {
        $evaluator = new WinEvaluator();

        $rows = [
                    ["14D", "14C", "14S", "5C", "10H"],
                    ["10D", "8C", "8D", "5D", "6H"],
                    ["12D", "3C", "2C", "5S", "7H"],
                    ["13D", "4C", "9C", "5H", "8H"],
                    ["11D", "7C", "10H", "8S", "9H"]
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

        $res = $evaluator->results($rows);

        $this->assertEquals($exp, $res);
    }
}
