<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectGrid\Grid;

class RuleStatsTest extends TestCase
{
    public function testSetGetRules(): void
    {
        $rules = new RuleStats();
        $possible = $this->createMock(RoyalFlushStat::class);
        $allRules = [
            [
                'name' => 'Test1',
                'possible' => $possible
            ]
        ];
        $rules->setRules($allRules);

        $res = $rules->getRules();
        $this->assertEquals($allRules, $res);
    }

    public function testCheckSinglePossible(): void
    {
        $rules = new RuleStats();
        $possible = $this->createMock(RoyalFlushStat::class);
        $allRules = [
            [
                'name' => 'Test1',
                'possible' => $possible
            ]
        ];
        $hand = [];
        $deck = [];
        for ($i = 2; $i < 5; $i++) {
            array_push($hand, strval($i)."H");
        }
        $rows = [
            2 => $hand
        ];
        $card = "11D";
        $possible->expects($this->once())->method('check')->with($hand, $deck, $card);
        $rules->setRules($allRules);
        $rules->checkSingle($rows, 2, $deck, $card, 0);
    }
}
