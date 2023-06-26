<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluator3Test extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"                                  ],
            3 => [            2 => "4C", 3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "12D";
        $deck = [
            "2C",
            "3C",
            "4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11C","11H",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Full House",
            'slot' => [1, 3],
            'row-rules-with-card' => ["", "Straight", "", "Full House", "One Pair"],
            'row-rules-without-card' => ["Full House", "Flush", "Straight", "Three Of A Kind", "Straight"],
            'col-rules-with-card' => ["Flush", "Straight" ,"", "Full House", "Straight"],
            'col-rules-without-card' => ["Straight", "Flush" ,"Flush", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"                                  ],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "11C";
        $deck = [
            "2C",
            "3C",
            "4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "One Pair",
            'col-rule' => "Flush",
            'slot' => [1, 2],
            'row-rules-with-card' => ["", "One Pair", "", "Two Pairs", "Three Of A Kind"],
            'row-rules-without-card' => ["Full House", "Flush", "Straight", "Full House", "Straight"],
            'col-rules-with-card' => ["One Pair", "One Pair", "Flush", "Two Pairs", ""],
            'col-rules-without-card' => ["Flush", "Flush" ,"Flush", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [            2 => "11C"                     ],
            2 => [0 => "7D"                                  ],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "2C";
        $deck = [
            "3C",
            "4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [2, 2],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "Straight", "Full House", "Straight"],
            'col-rules-with-card' => ["", "Straight", "Flush", "", ""],
            'col-rules-without-card' => ["Flush", "Flush" ,"Flush", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [            2 => "11C"                     ],
            2 => [0 => "7D",  2 => "2C"                      ],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "13H";
        $deck = [
            "3C",
            "4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Flush",
            'slot' => [4, 4],
            'row-rules-with-card' => ["", "", "", "", "Straight"],
            'row-rules-without-card' => ["Full House", "Two Pairs", "", "Full House", "Two Pairs"],
            'col-rules-with-card' => ["", "", "", "", "Flush"],
            'col-rules-without-card' => ["Flush", "Flush" ,"", "Two Pairs", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion5(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [2 => "11C"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "4S";
        $deck = [
            "3C",
            "4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [3, 1],
            'row-rules-with-card' => ["", "Two Pairs", "", "Full House", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "", "Two Pairs", "Straight"],
            'col-rules-with-card' => ["", "Flush", "", "Two Pairs", ""],
            'col-rules-without-card' => ["Flush", "Two Pairs" ,"", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",             2 => "8C", 3 => "5D",  4 => "8H" ],
            1 => [                       2 => "11C"                       ],
            2 => [0 => "7D",             2 => "2C"                        ],
            3 => [0 => "12D", 1 => "4S", 2 => "4C", 3 => "12S"            ],
            4 => [0 => "11D",            2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "14S";
        $deck = [
            "3C",
            "4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [4, 1],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "", "Full House", "Straight"],
            'col-rules-with-card' => ["", "Flush", "", "", ""],
            'col-rules-without-card' => ["Flush", "Two Pairs" ,"", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",              2 => "8C", 3 => "5D",  4 => "8H" ],
            1 => [            1 => "14S", 2 => "11C"                       ],
            2 => [0 => "7D",              2 => "2C"                        ],
            3 => [0 => "12D", 1 => "4S",  2 => "4C", 3 => "12S"            ],
            4 => [0 => "11D",             2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "5H";
        $deck = [
            "3C",
            "4H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11H"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 1],
            'row-rules-with-card' => ["Full House", "", "", "", ""],
            'row-rules-without-card' => ["Three Of A Kind", "One Pair", "", "Full House", "Straight"],
            'col-rules-with-card' => ["", "", "", "Two Pairs", "Flush"],
            'col-rules-without-card' => ["Flush", "Flush" ,"", "Two Pairs", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  1 => "5H",  2 => "8C", 3 => "5D",  4 => "8H"],
            1 => [            1 => "14S", 2 => "11C"                       ],
            2 => [0 => "7D",              2 => "2C"                        ],
            3 => [0 => "12D", 1 => "4S",  2 => "4C", 3 => "12S"            ],
            4 => [0 => "11D",             2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "11H";
        $deck = [
            "3C",
            "4H",
            "6S","6D",
            "9S",
            "10S","10C",
        ];

        $exp = [
            'row-rule' => "One Pair",
            'col-rule' => "",
            'slot' => [4, 1],
            'row-rules-with-card' => ["", "One Pair", "", "", "One Pair"],
            'row-rules-without-card' => ["", "", "", "Full House", "Straight"],
            'col-rules-with-card' => ["One Pair", "", "", "", ""],
            'col-rules-without-card' => ["Flush", "One Pair" ,"", "Two Pairs", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  1 => "5H",  2 => "8C", 3 => "5D",  4 => "8H" ],
            1 => [            1 => "14S", 2 => "11C",            4 => "11H"],
            2 => [0 => "7D",              2 => "2C"                        ],
            3 => [0 => "12D", 1 => "4S",  2 => "4C", 3 => "12S"            ],
            4 => [0 => "11D",             2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "3C";
        $deck = [
            "4H",
            "6S","6D",
            "9S",
            "10S","10C",
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [4, 1],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["", "Two Pairs", "", "Full House", "Straight"],
            'col-rules-with-card' => ["", "", "", "", ""],
            'col-rules-without-card' => ["Flush", "One Pair" ,"", "Two Pairs", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
