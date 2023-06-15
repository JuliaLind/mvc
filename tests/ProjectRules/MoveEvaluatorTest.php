<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluatorTest extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        // note to self!!!! lägg till fler tester

        $rows = [
            0 => [0 => "14D", 1 => "14C", 2 => "14S", 3 => "5C", 4 => "10H"],
            1 => [0 => "10D", 1 => "8C", 2 => "8D", 4 => "6H"],
            2 => [0 => "12D", 1 => "3C", 2 => "2C", 3 => "5S", 4 => "7H"],
            3 => [0 => "13D", 1 => "4C", 2 => "9C", 3 => "5H", 4 => "8H"],
            4 => [0 => "11D", 1 => "7C", 2 => "10H", 3 => "8S", 4 => "9H"],
        ];

        // $hands= [
        //     'rows' => [
        //         0 => [0 => "14D", 1 => "14C", 2 => "14S", 3 => "5C", 4 => "10H"],
        //         1 => [0 => "10D", 1 => "8C", 2 => "8D", 4 => "6H"],
        //         2 => [0 => "12D", 1 => "3C", 2 => "2C", 3 => "5S", 4 => "7H"],
        //         3 => [0 => "13D", 1 => "4C", 2 => "9C", 3 => "5H", 4 => "8H"],
        //         4 => [0 => "11D", 1 => "7C", 2 => "10H", 3 => "8S", 4 => "9H"],
        //     ],
        //     'cols' => [
        //         0 => [0 => "14D", 1 => "10D", 2 => "12D", 3 => "13D", 4 => "11D"],
        //         1 => [0 => "14C", 1 => "8C", 2 => "3C", 3 => "4C", 4 => "7C"],
        //         2 => [0 => "14S", 1 => "8D", 2 => "2C", 3 => "9C", 4 => "10H"],
        //         3 => [0 => "5C", 2 => "5S", 3 => "5H", 4 => "8S"],
        //         4 => [0 => "10H", 1 => "6H", 2 => "7H", 3 => "8H", 4 => "9H"],
        //     ]
        // ];

        $card = "5D";
        $deck = [];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Four Of A Kind",
            'slot' => [1, 3]
        ];

        // $res = $evaluator->suggestion($hands, $card, $deck);
        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "14D", 1 => "13C", 2 => "12S", 3 => "11C", 4 => "10H"],
        ];
        // $hands = [
        //     'rows' => [
        //         0 => [0 => "14D", 1 => "13C", 2 => "12S", 3 => "11C", 4 => "10H"],
        //     ],
        //     'cols' => [
        //         0 => [0 => "14D"],
        //         1 => [0 => "13C"],
        //         2 => [0 => "12S"],
        //         3 => [0 => "11C"],
        //         4 => [0 => "10H"],
        //     ]
        // ];

        $card = "12H";
        $deck = [];

        $exp = [
            'row-rule' => "",
            'col-rule' => "One Pair",
            'slot' => [4, 2]
        ];

        // $res = $evaluator->suggestion($hands, $card, $deck);
        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();
        // $rowsAndCols = [
        //     'rows' => [],
        //     'cols' => []
        // ];

        $rows = [];

        $deck = ["14C", "8C", "3C", "4C", "7C"];
        $card = "14D";

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [0, 0]
        ];

        // $res = $evaluator->suggestion($rowsAndCols, $card, $deck);
        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }
}
