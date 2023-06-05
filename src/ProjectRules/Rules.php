<?php

namespace App\ProjectRules;

class Rules
{
    /**
     * @var array<string,string|int|RuleInterface|RuleStatInterface>
     */
    protected $rules = [];

    public function __construct()
    {
        $rules = [
            'Royal Flush' => [
                'points' => 100,
            ],
            'Straight Flush' => [
                'points' => 70,
            ],
            'Four Of A Kind' => [
                'points' => 50,
                'scored' => new SameOfAKind(4)
            ],
            'Full House' => [
                'points' => 25,
            ],
            'Flush' => [
                'points' => 20,
            ],
            'Straight' => [
                'points' => 15,
            ],
            'Three Of A Kind' => [
                'points' => 10,
                'scored' => new SameOfAKind(3)
            ],
            'Two Pairs' => [
                'points' => 5,
            ],
            'One Pair' => [
                'points' => 2,
                'scored' => new SameOfAKind(2)
            ],
        ];
    }
}
