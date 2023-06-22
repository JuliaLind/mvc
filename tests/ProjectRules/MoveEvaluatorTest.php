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

        $card = "5D";
        $deck = [];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Four Of A Kind",
            'slot' => [1, 3]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();


        $rows = [];

        $deck = ["14C", "8C", "3C", "4C", "7C"];
        $card = "14D";

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [0, 0]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "14D", 1 => "13C", 2 => "12S", 3 => "11C", 4 => "10H"],
        ];

        $card = "12H";
        $deck = [];

        $exp = [
            'row-rule' => "",
            'col-rule' => "One Pair",
            'slot' => [4, 2]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
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
            'col-rule' => "",
            'slot' => [0, 4]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion5(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "11C", 2 => "11H", 3 => "6D", 4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S", 2 => "4D", 3 => "3H", 4 => "4H"],
            4 => [0 => "9C", 1 => "5D", 4 => "8H"]
        ];

        $card = "10S";
        $deck = [
            "2S", "12H", "2C", "4C",
            "5S", "10D", "14D", "6C"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [4, 3]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "11C", 2 => "11H", 3 => "6D", 4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S", 2 => "4D", 3 => "3H", 4 => "4H"],
            4 => [0 => "9C", 1 => "5D", 3=>"10S", 4 => "8H"]
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
            'slot' => [0, 1]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }


    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "5C", 4 => "12S"],
            1 => [0 => "4H"]
        ];

        $card = "3S";
        $deck = [
            "9H",
            "4C",
            "3H",
            "10D",
            "5H",
            "8D",
            "6C",
            "9C",
            "11H",
            "12C",
            "14H",
            "3C",
            "13H",
            "5D",
            "11S",
            "2C",
            "7S",
            "12D",
            "8H",
            "9S",
            "13D"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [1, 4]
        ];


        $res = $evaluator->suggestion($rows, $card, $deck);

        $this->assertEquals($exp, $res);
    }
}
