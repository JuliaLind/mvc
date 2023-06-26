<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluatorTest extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "11C"],
        ];

        $card = "6H";
        $deck = [
            "2S", "12H", "2C", "4C", "5S", "10D", "14D", "6C",
            "10S", "9S", "4D", "13C", "11H", "13D", "6D",
            "14H", "3H", "4H", "5D", "13S", "14S", "9C", "8H"
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

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "11C",             2 => "11H", 3 => "6D",  4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S",              2 => "4D",  3 => "3H",  4 => "4H"],
            4 => [0 => "9C",  1 => "5D",                         4 => "8H"]
        ];

        $card = "10S";
        $deck = [
            "2S", "12H", "2C", "4C",
            "5S", "10D", "14D", "6C"
        ];

        $exp = [
            'row-rule' => "One Pair",
            'col-rule' => "",
            'slot' => [2, 4],
            'row-rules-with-card' => ["", "", "One Pair", "", ""],
            'row-rules-without-card' => ["Full House", "", "One Pair", "Three Of A Kind", "One Pair"],
            'col-rules-with-card' => ["", "" ,"", "", ""],
            'col-rules-without-card' => ["One Pair", "Two Pairs" ,"One Pair", "One Pair", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "11C",             2 => "11H", 3 => "6D",  4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S",              2 => "4D",  3 => "3H",  4 => "4H"],
            4 => [0 => "9C",  1 => "5D",              3=>"10S",   4 => "8H"]
        ];

        $card = "6C";
        $deck = [
            "2S",
            "12H",
            "2C",
            "4C",
            "5S",
            "10D",
            "14D"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 1],
            'row-rules-with-card' => ["Full House", "", "", "", ""],
            'row-rules-without-card' => ["Two Pairs", "", "One Pair", "Three Of A Kind", "One Pair"],
            'col-rules-with-card' => ["", "" ,"", "One Pair", "One Pair"],
            'col-rules-without-card' => ["One Pair", "Two Pairs" ,"One Pair", "One Pair", "Flush"]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }


    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "5C", 4 => "12S"],
            1 => [0 => "4H"]
        ];

        $card = "3S";
        $deck = ["9H","4C","3H","10D","5H",
            "8D","6C","9C","11H","12C",
            "14H","3C","13H","5D","11S",
            "2C", "7S", "12D", "8H", "9S",
            "13D"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [1, 4],
            'row-rules-with-card' => ["", "Full House", "Full House", "Full House", "Full House"],
            'row-rules-without-card' => ["Full House", "Full House", "Full House", "Full House", "Full House"],
            'col-rules-with-card' => ["Straight", "Full House" ,"Full House", "Full House", "Full House"],
            'col-rules-without-card' => ["Full House", "Full House" ,"Full House", "Full House", "Full House"]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }
}
