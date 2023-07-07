<?php

namespace App\ProjectEvaluator;

use PHPUnit\Framework\TestCase;

class RuleEvaluatorTest extends TestCase
{
    /**
     * test create a rules evaluator and make sure the rules
     * of the evaualtor are in "correct" order, otherwise all methods
     * will produce logical errors
     */
    public function testCreateObject(): void
    {
        $evaluator = new RuleEvaluator();

        $rules = $evaluator->getRules();

        $res = [];
        foreach ($rules as $rule) {
            $res[] = [
                'name' => $rule->getName(),
                'points' => $rule->getPoints()
            ];
        }
        $exp = [
            [
                'name' => 'Royal Flush',
                'points' => 100
            ],
            [
                'name' => 'Straight Flush',
                'points' => 75
            ],
            [
                'name' => 'Four Of A Kind',
                'points' => 50
            ],
            [
                'name' => 'Full House',
                'points' => 25
            ],
            [
                'name' => 'Flush',
                'points' => 20
            ],
            [
                'name' => 'Straight',
                'points' => 15
            ],
            [
                'name' => 'Three Of A Kind',
                'points' => 10
            ],
            [
                'name' => 'Two Pairs',
                'points' => 5
            ],
            [
                'name' => 'One Pair',
                'points' => 2
            ],
        ];
        $this->assertEquals($exp, $res);
    }
}
