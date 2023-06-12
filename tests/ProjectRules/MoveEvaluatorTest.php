<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Card;
use App\ProjectCard\Deck;

class MoveEvaluatorTest extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        /// lägg till många fler tester

        // KEEP AS TEMPLATE
        // $hands= [
        //     'rows' => [
        //         0 => [0 => new Card(14, 'D'), 1 => new Card(14, 'C'), 2 => new Card(14, 'S'), 3 => new Card(5, 'C'), 4 => new Card(10, 'H')],
        //         1 => [0 => new Card(10, 'D'), 1 => new Card(8, 'C'), 2 => new Card(8, 'D'), 3 => new Card(5, 'D'), 4 => new Card(6, 'H')],
        //         2 => [0 => new Card(12, 'D'), 1 => new Card(3, 'C'), 2 => new Card(2, 'C'), 3 => new Card(5, 'S'), 4 => new Card(7, 'H')],
        //         3 => [0 => new Card(13, 'D'), 1 => new Card(4, 'C'), 2 => new Card(9, 'C'), 3 => new Card(5, 'H'), 4 => new Card(8, 'H')],
        //         4 => [0 => new Card(11, 'D'), 1 => new Card(7, 'C'), 2 => new Card(10, 'H'), 3 => new Card(8, 'S'), 4 => new Card(9, 'H')],
        //     ],
        //     'cols' => [
        //         0 => [
        //             0 => new Card(14, 'D'), 1 => new Card(10, 'D'), 2 => new Card(12, 'D'), 3 => new Card(13, 'D'), 4 => new Card(11, 'D')
        //         ],
        //         1 => [
        //             0 => new Card(14, 'C'), 1 => new Card(8, 'C'), 2 => new Card(3, 'C'), 3 => new Card(4, 'C'), 4 => new Card(7, 'C')
        //         ],
        //         2 => [
        //             0 => new Card(14, 'S'), 1 => new Card(8, 'D'), 2 => new Card(2, 'C'), 3 => new Card(9, 'C'), 4 => new Card(10, 'H')
        //         ],
        //         3 => [
        //             0 => new Card(5, 'C'), 1 => new Card(5, 'D'), 2 => new Card(5, 'S'), 3 => new Card(5, 'H'), 4 => new Card(8, 'S')
        //         ],
        //         4 => [
        //             0 => new Card(10, 'H'), 1 => new Card(6, 'H'), 2 => new Card(7, 'H'), 3 => new Card(8, 'H'), 4 => new Card(9, 'H')
        //         ],
        //     ]
        // ];

        $hands= [
            'rows' => [
                0 => [0 => new Card(14, 'D'), 1 => new Card(14, 'C'), 2 => new Card(14, 'S'), 3 => new Card(5, 'C'), 4 => new Card(10, 'H')],
                1 => [0 => new Card(10, 'D'), 1 => new Card(8, 'C'), 2 => new Card(8, 'D'), 4 => new Card(6, 'H')],
                2 => [0 => new Card(12, 'D'), 1 => new Card(3, 'C'), 2 => new Card(2, 'C'), 3 => new Card(5, 'S'), 4 => new Card(7, 'H')],
                3 => [0 => new Card(13, 'D'), 1 => new Card(4, 'C'), 2 => new Card(9, 'C'), 3 => new Card(5, 'H'), 4 => new Card(8, 'H')],
                4 => [0 => new Card(11, 'D'), 1 => new Card(7, 'C'), 2 => new Card(10, 'H'), 3 => new Card(8, 'S'), 4 => new Card(9, 'H')],
            ],
            'cols' => [
                0 => [
                    0 => new Card(14, 'D'), 1 => new Card(10, 'D'), 2 => new Card(12, 'D'), 3 => new Card(13, 'D'), 4 => new Card(11, 'D')
                ],
                1 => [
                    0 => new Card(14, 'C'), 1 => new Card(8, 'C'), 2 => new Card(3, 'C'), 3 => new Card(4, 'C'), 4 => new Card(7, 'C')
                ],
                2 => [
                    0 => new Card(14, 'S'), 1 => new Card(8, 'D'), 2 => new Card(2, 'C'), 3 => new Card(9, 'C'), 4 => new Card(10, 'H')
                ],
                3 => [
                    0 => new Card(5, 'C'), 2 => new Card(5, 'S'), 3 => new Card(5, 'H'), 4 => new Card(8, 'S')
                ],
                4 => [
                    0 => new Card(10, 'H'), 1 => new Card(6, 'H'), 2 => new Card(7, 'H'), 3 => new Card(8, 'H'), 4 => new Card(9, 'H')
                ],
            ]
        ];

        $card = new Card(5, 'D');
        $deck = [];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Four Of A Kind",
            'slot' => [1, 3]
        ];

        $res = $evaluator->suggestion($hands, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();
        $rowsAndCols = [
            'rows' => [],
            'cols' => []
        ];

        $deck = [new Card(14, 'C'), new Card(8, 'C'), new Card(3, 'C'), new Card(4, 'C'), new Card(7, 'C')];
        $card = new Card(14, 'D');

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [0, 0]
        ];

        $res = $evaluator->suggestion($rowsAndCols, $card, $deck);

        $this->assertEquals($exp, $res);
    }
}
