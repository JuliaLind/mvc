<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluatorBetter4Test extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S",                       3 => "7S", 4 => "7D" ],
            2 => [0 => "14H",                                  4 => "14D"],
            3 => [                       2 => "6h", 3 => "8D"            ],
            4 => [0 => "11S", 1 => "2C", 2 => "2D",            4 => "11C"]
        ];

        $card = "7H";

        $deck = [
            "3C",
            "4S",
            "5C","5S","5H",
            "8S","8C",
            "10D","10H",
            "11D",
            "12H",
            "13D",
            "14C"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 2],
            'row-rules-with-card' => ["Full House", "", "", "Straight", ""],
            'row-rules-without-card' => ["Two Pairs", "Full House", "Full House", "Three Of A Kind", "Full House"],
            'col-rules-with-card' => ["", "", "", "Full House", "One Pair"],
            'col-rules-without-card' => ["Straight", "Flush" ,"Straight", "Three Of A Kind", "Two Pairs"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S",            2 => "7H", 3 => "7S", 4 => "7D" ],
            2 => [0 => "14H",                                  4 => "14D"],
            3 => [                       2 => "6h", 3 => "8D"            ],
            4 => [0 => "11S", 1 => "2C", 2 => "2D",            4 => "11C"]
        ];

        $card = "5C";

        $deck = [
            "3C",
            "4S",
            "5S","5H",
            "8S","8C",
            "10D","10H",
            "11D",
            "12H",
            "13D",
            "14C"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [1, 1],
            'row-rules-with-card' => ["", "Full House", "Full House", "", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "Three Of A Kind", "Three Of A Kind", "Full House"],
            'col-rules-with-card' => ["", "Flush", "", "", ""],
            'col-rules-without-card' => ["Straight", "" ,"", "Three Of A Kind", "Two Pairs"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 1 => "5C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "14C";

        $deck = [
            "3C",
            "4S",
            "5S","5H",
            "8S","8C",
            "10D","10H",
            "11D",
            "12H",
            "13D"
        ];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Flush",
            'slot' => [1, 1],
            'row-rules-with-card' => ["", "Straight", "Full House", "", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "Full House", "Three Of A Kind", "Full House"],
            'col-rules-with-card' => ["One Pair", "Flush", "", "", "One Pair"],
            'col-rules-without-card' => ["Straight", "Three Of A Kind" ,"", "Three Of A Kind", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "4S";

        $deck = [
            "3C",
            "5S","5H",
            "8S","8C",
            "10D","10H",
            "11D",
            "12H",
            "13D"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [1, 2],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "Two Pairs", "Full House", "Three Of A Kind", "Full House"],
            'col-rules-with-card' => ["", "", "", "", ""],
            'col-rules-without-card' => ["Straight", "Three Of A Kind" ,"", "Three Of A Kind", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion5(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "3C";

        $deck = [
            "5S","5H",
            "8S","8C",
            "10D","10H",
            "11D",
            "12H",
            "13D"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [1, 2],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "", "Full House", "Three Of A Kind", "Full House"],
            'col-rules-with-card' => ["", "", "", "", ""],
            'col-rules-without-card' => ["Straight", "Three Of A Kind" ,"", "Three Of A Kind", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "10D";

        $deck = [
            "5S","5H",
            "8S","8C",
            "10H",
            "11D",
            "12H",
            "13D"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [1, 2],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "", "Full House", "Three Of A Kind", ""],
            'col-rules-with-card' => ["Straight", "", "", "", ""],
            'col-rules-without-card' => ["Straight", "Three Of A Kind" ,"", "One Pair", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S",            2 => "7H", 3 => "7S",  4 => "7D" ],
            1 => [                                              4 => "4S" ],
            2 => [0 => "14H", 1 => "5C",            3 => "14C", 4 => "14D"],
            3 => [0 => "10D",            2 => "6h", 3 => "8D"             ],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C",  4 => "11C"]
        ];

        $card = "5S";

        $deck = [
            "5H",
            "8S","8C",
            "10H",
            "11D",
            "12H",
            "13D"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Three Of A Kind",
            'slot' => [1, 1],
            'row-rules-with-card' => ["", "", "Full House", "", ""],
            'row-rules-without-card' => ["Full House", "", "Full House", "Three Of A Kind", ""],
            'col-rules-with-card' => ["", "Three Of A Kind", "", "", ""],
            'col-rules-without-card' => ["Straight", "One Pair" ,"", "One Pair", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D", 2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "13D";

        $deck = [
            "5H",
            "8S","8C",
            "10H",
            "11D",
            "12H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Straight",
            'slot' => [1, 0],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "", "", "Three Of A Kind", ""],
            'col-rules-with-card' => ["Straight", "", "", "", ""],
            'col-rules-without-card' => ["One Pair", "One Pair" ,"One Pair", "One Pair", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S",            2 => "7H", 3 => "7S",  4 => "7D" ],
            1 => [0 => "13D",                                   4 => "4S" ],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D",            2 => "6h", 3 => "8D"             ],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C",  4 => "11C"]
        ];

        $card = "8S";

        $deck = [
            "5H",
            "8C",
            "10H",
            "11D",
            "12H"
        ];

        $exp = [
            'row-rule' => "Three Of A Kind",
            'col-rule' => "",
            'slot' => [3, 4],
            'row-rules-with-card' => ["", "", "", "Three Of A Kind", ""],
            'row-rules-without-card' => ["Full House", "", "", "Two Pairs", ""],
            'col-rules-with-card' => ["", "", "", "One Pair", ""],
            'col-rules-without-card' => ["", "One Pair" ,"One Pair", "One Pair", "One Pair"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion10(): void
    {
        $evaluator = new MoveEvaluatorBetter();

        $rows = [
            0 => [0 => "12S",            2 => "7H", 3 => "7S",  4 => "7D" ],
            1 => [0 => "13D",                                   4 => "4S" ],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D",            2 => "6h", 3 => "8D",  4 => "8S" ],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C",  4 => "11C"]
        ];

        $card = "11D";

        $deck = [
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [1, 3],
            'row-rules-with-card' => ["", "", "", "", ""],
            'row-rules-without-card' => ["Full House", "", "", "Three Of A Kind", ""],
            'col-rules-with-card' => ["", "", "", "", ""],
            'col-rules-without-card' => ["", "One Pair" ,"One Pair", "One Pair", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
