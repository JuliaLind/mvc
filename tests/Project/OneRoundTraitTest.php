<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class OneRoundTraitTest extends TestCase
{
    use OneRoundTrait;
    use PlayerSuggestTrait;
    use HousePlaceCardTrait;


    public function testOneRoundNotFinished(): void
    {
        $housePossible = ["5C","7H","8D","8H","9C","10S","10H","11H","11C","13D","14D","14S"];
        $card ="5H";
        $row = 1;
        $col = 3;

        $deck = $this->createMock(Deck::class);
        $deck->method('deal')->will($this->onConsecutiveCalls("10D", "8H"));
        $deck->method('possibleCards')->will($this->onConsecutiveCalls(
            $housePossible
        ));

        $house = $this->createMock(Grid::class);
        $house->method('getCardCount')->willReturn(24);

        $player = $this->createMock(Grid::class);
        $player->expects($this->once())
        ->method('addCard')->with($row, $col, $card);
        $house->expects($this->once())
        ->method('addCard')->with(2, 1, "10D");

        $houseSuggestion = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            //.... rest not needed in this test
        ];
        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->once())->method('suggestion')->with($this->equalTo($house), $this->equalTo("10D"), $this->equalTo($housePossible))->willReturn($houseSuggestion);

        $this->card = $card;
        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->player = $player;
        $this->deck = $deck;

        $res = $this->oneRound($row, $col);
        $this->assertFalse($res);
        $this->assertEquals([1, 3], $this->lastRound['player']);
        $this->assertEquals([2, 1], $this->lastRound['house']);
        $this->assertEquals("8H", $this->card);
        $this->assertFalse($this->finished);
    }

    public function testOneRoundFinished(): void
    {
        $housePossible = ["5C","7H","8D","8H","9C","10S","10H","11H","11C","13D","14D","14S"];
        $card ="5H";
        $row = 1;
        $col = 3;

        $deck = $this->createMock(Deck::class);
        $deck->method('deal')->will($this->onConsecutiveCalls("10D", "8H"));
        $deck->method('possibleCards')->willReturn($housePossible);

        $house = $this->createMock(Grid::class);
        $house->method('getCardCount')->willReturn(25);

        $player = $this->createMock(Grid::class);
        $player->expects($this->once())
        ->method('addCard')->with($row, $col, $card);
        $house->expects($this->once())
        ->method('addCard')->with(2, 1, "10D");

        $houseSuggestion = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            //.... rest not needed in this test
        ];


        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->once())->method('suggestion')->willReturn($houseSuggestion);

        $this->card = $card;
        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->player = $player;
        $this->deck = $deck;

        $res = $this->oneRound($row, $col);
        $this->assertTrue($res);
        $this->assertEquals([1, 3], $this->lastRound['player']);
        $this->assertEquals([2, 1], $this->lastRound['house']);
        $this->assertEquals("8H", $this->card);
        $this->assertTrue($this->finished);
    }
}
