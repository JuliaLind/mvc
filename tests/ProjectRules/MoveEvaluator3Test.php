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
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"],
            3 => [2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "12D";
        $deck = [
            "11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [3, 0]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "11C";
        $deck = [
            "2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [1, 2]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [2 => "11C"],
            2 => [0 => "7D"],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "2C";
        $deck = [
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [2, 2]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [2 => "11C"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "13H";
        $deck = [
            "4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Flush",
            'slot' => [4, 4]
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
            "14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [3, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [2 => "11C"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 1 => "4S", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "14S";
        $deck = [
            "5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [4, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [1 => "14S", 2 => "11C"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 1 => "4S", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "5H";
        $deck = [
            "11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 1 => "5H", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [1 => "14S", 2 => "11C"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 1 => "4S", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "11H";
        $deck = [
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "One Pair",
            'col-rule' => "",
            'slot' => [4, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 1 => "5H", 2 => "8C", 3 => "5D", 4 => "8H"],
            1 => [1 => "14S", 2 => "11C", 4 => "11H"],
            2 => [0 => "7D", 2 => "2C"],
            3 => [0 => "12D", 1 => "4S", 2 => "4C", 3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H", 4 => "13H"]
        ];

        $card = "3C";
        $deck = [
            "10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [4, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
