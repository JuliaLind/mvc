<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluator2Test extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [];

        $card = "8D";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5D","5H",
            "6S","6D",
            "7D",
            "8H","8C",
            "9C","9S",
            "10S","10C",
            "11D","11C","11H",
            "12H","12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 0],
            'row-rules-with-card' => ["Full House", "", "", "", ""],
            'row-rules-without-card' => ["", "", "", "", ""],
            'col-rules-with-card' => ["Full House", "" ,"", "", ""],
            'col-rules-without-card' => ["", "" ,"", "", ""]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => ["8D"]
        ];

        $card = "8H";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5D","5H",
            "6S","6D",
            "7D",
            "8C",
            "9C","9S",
            "10S","10C",
            "11D","11C","11H",
            "12H","12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            'row-rules-with-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Full House", "Full House" ,"Full House", "Full House", "Full House"],
            'col-rules-without-card' => ["Full House", "Full House" ,"Full House", "Full House", "Full House"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 4 => "8H"]
        ];

        $card = "5D";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S", "6D",
            "7D",
            "8C",
            "9C","9S",
            "10S","10C",
            "11D","11C","11H",
            "12H","12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 3],
            'row-rules-with-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Flush", "Full House" ,"Full House", "Full House", "Straight"],
            'col-rules-without-card' => ["Full House", "Full House" ,"Full House", "Full House", "Full House"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 3 => "5D", 4 => "8H"]
        ];

        $card = "8C";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "7D",
            "9C","9S",
            "10S","10C",
            "11D","11C","11H",
            "12H","12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [0, 2],
            'row-rules-with-card' => ["Full House", "Flush", "Flush", "Flush", "Flush"],
            'row-rules-without-card' => ["Two Pairs", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Full House", "Flush" ,"Flush", "Straight", "Full House"],
            'col-rules-without-card' => ["Flush", "Full House" ,"Full House", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }


    public function testSuggestion5(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"]
        ];

        $card = "12H";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "7D",
            "9C","9S",
            "10S","10C",
            "11D","11C","11H",
            "12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [4, 3],
            'row-rules-with-card' => ["", "Full House", "Full House", "Full House", "Full House"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Straight", "Full House" ,"Straight", "Full House", "Flush"],
            'col-rules-without-card' => ["Flush", "Full House" ,"Flush", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            4 => [                      3 => "12H"]
        ];

        $card = "11D";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "7D",
            "9C","9S",
            "10S","10C",
            "11C","11H",
            "12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [4, 1],
            'row-rules-with-card' => ["", "Full House", "Full House", "Full House", "Full House"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Flush", "Full House" ,"Straight", "", "Straight"],
            'col-rules-without-card' => ["Straight", "Full House" ,"Flush", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            4 => [0 => "11D",           3 => "12H"          ]
        ];

        $card = "9C";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "7D",
            "9S",
            "10S","10C",
            "11C","11H",
            "12S","12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [3, 1],
            'row-rules-with-card' => ["", "Full House", "Full House", "Full House", "Straight"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Straight", "Full House" ,"Flush", "", "Straight"],
            'col-rules-without-card' => ["Flush", "Full House" ,"Flush", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "12S";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "7D",
            "9S",
            "10S","10C",
            "11C","11H",
            "12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [3, 3],
            'row-rules-with-card' => ["", "Full House", "Full House", "Full House", "Three Of A Kind"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Straight"],
            'col-rules-with-card' => ["Straight", "Full House" ,"Straight", "Full House", "Straight"],
            'col-rules-without-card' => ["Flush", "Full House" ,"Flush", "Two Pairs", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            3 => [                       3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "7D";
        $deck = [
            "2C",
            "3C",
            "4C","4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11C","11H",
            "12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Flush",
            'slot' => [2, 0],
            'row-rules-with-card' => ["", "Straight", "Straight", "", ""],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Straight"],
            'col-rules-with-card' => ["Flush", "Straight" ,"Straight", "", "Straight"],
            'col-rules-without-card' => ["Straight", "Full House" ,"Flush", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion10(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D",  2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"                                  ],
            3 => [                       3 => "12S"          ],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"          ]
        ];

        $card = "4C";
        $deck = [
            "2C",
            "3C",
            "4S","4H",
            "5H",
            "6S","6D",
            "9S",
            "10S","10C",
            "11C","11H",
            "12D",
            "13H",
            "14S"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [3, 2],
            'row-rules-with-card' => ["", "Full House", "Straight", "Full House", ""],
            'row-rules-without-card' => ["Full House", "Flush", "Straight", "Flush", "Straight"],
            'col-rules-with-card' => ["", "Full House" ,"Flush", "Two Pairs", ""],
            'col-rules-without-card' => ["Flush", "Flush" ,"Flush", "Full House", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
