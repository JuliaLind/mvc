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
            "8H","5D","8C","12H","11D",
            "9C","12S","7D","4C","12D",
            "11C","2C","13H","4S","14S",
            "5H","11H","3C","10S","10C",
            "6S","6D","4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 0]
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
            "5D","8C","12H","11D","9C",
            "12S","7D","4C","12D","11C",
            "2C","13H","4S","14S","5H",
            "11H","3C","10S","10C","6S",
            "6D","4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 4]
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
            "8C","12H","11D","9C", "12S",
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 3]
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
            "12H","11D","9C", "12S",
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 2]
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
            "11D","9C", "12S",
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Full House",
            'slot' => [4, 3]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            4 => [3 => "12H"]
        ];

        $card = "11D";
        $deck = [
            "9C", "12S",
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [4, 0]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            4 => [0 => "11D", 3 => "12H"]
        ];

        $card = "9C";
        $deck = [
            "12S",
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Straight",
            'col-rule' => "Flush",
            'slot' => [4, 2]
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
            "7D","4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Full House",
            'slot' => [3, 3]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            3 => [3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "7D";
        $deck = [
            "4C","12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Flush",
            'slot' => [2, 0]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion10(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "8D", 2 => "8C", 3 => "5D", 4 => "8H"],
            2 => [0 => "7D"],
            3 => [3 => "12S"],
            4 => [0 => "11D", 2 => "9C", 3 => "12H"]
        ];

        $card = "4C";
        $deck = [
            "12D","11C","2C",
            "13H","4S","14S","5H","11H",
            "3C","10S","10C","6S", "6D",
            "4H","9S"];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [3, 2]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
