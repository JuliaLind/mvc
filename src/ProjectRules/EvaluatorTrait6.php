<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait EvaluatorTrait6
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     */
    abstract public function checkForRule(array $hands, int $index, array $deck, string $card): bool;

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return  array<string,array<int,array<string,int|string>>|int|string>
     */
    public function points(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = 0;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->checkForRule($hands, $j, $deck, $card);
            $handPoints = $data['points'];
            $handRule = $data['rule'];
            if ($handPoints >= $maxPoints) {
                $maxPoints = $handPoints;
                $bestHand = $j;
            }
            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
        }
        return [
            'max' => $maxPoints,
            'bestHand' => $bestHand,
            'points' => $pointsHands
        ];
    }
}
