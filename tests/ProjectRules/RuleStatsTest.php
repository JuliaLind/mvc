<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
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
        for ($i = 0; $i < 3; $i++) {
            array_push($hand, $this->createMock(Card::class));
        }
        $card = $this->createMock(Card::class);
        $possible->expects($this->once())->method('check')->with($hand, $deck, $card);
        $rules->setRules($allRules);
        $rules->checkSingle($hand, $deck, $card, 0);
    }
}
