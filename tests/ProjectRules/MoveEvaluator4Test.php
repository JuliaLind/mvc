<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\Deck;

class MoveEvaluator4Test extends TestCase
{
    public function testSuggestion(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "7H";

        $deck = [
            "5C",
            "14C",
            "4S",
            "3C",
            "10D",
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 2]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "5C";

        $deck = [
            "14C",
            "4S",
            "3C",
            "10D",
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Flush",
            'slot' => [2, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 1 => "5C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "14C";

        $deck = [
            "4S",
            "3C",
            "10D",
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [2, 3]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "4S";

        $deck = [
            "3C",
            "10D",
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [1, 4]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion5(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 4 => "11C"]
        ];

        $card = "3C";

        $deck = [
            "10D",
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
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
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "10D";

        $deck = [
            "5S",
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Straight",
            'slot' => [3, 0]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion7(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D", 2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "5S";

        $deck = [
            "13D",
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [2, 2]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion8(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D", 2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "13D";

        $deck = [
            "8S",
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "",
            'col-rule' => "Straight",
            'slot' => [1, 0]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion9(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [0 => "13D", 4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D", 2 => "6h", 3 => "8D"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
        ];

        $card = "8S";

        $deck = [
            "11D",
            "10H",
            "5H",
            "8C",
            "12H"
        ];

        $exp = [
            'row-rule' => "Three Of A Kind",
            'col-rule' => "",
            'slot' => [3, 4]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion10(): void
    {
        $evaluator = new MoveEvaluator();

        $rows = [
            0 => [0 => "12S", 2 => "7H", 3 => "7S", 4 => "7D"],
            1 => [0 => "13D", 4 => "4S"],
            2 => [0 => "14H", 1 => "5C", 2 => "5S", 3 => "14C", 4 => "14D"],
            3 => [0 => "10D", 2 => "6h", 3 => "8D", 4 => "8S"],
            4 => [0 => "11S", 1 => "2C", 2 => "2D", 3 => "3C", 4 => "11C"]
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
            'slot' => [3, 1]
        ];

        $res = $evaluator->suggestion($rows, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
