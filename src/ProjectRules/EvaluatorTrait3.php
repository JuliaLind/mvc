<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait EvaluatorTrait3
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
     * @return array<string,string|int>
     */
    abstract public function checkForRule2(array $hands, int $index, array $deck);

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return  array<string,array<int,array<string,int|string>>|int|string>
     */
    public function pointsWithoutCard(array $hands, array $deck): array
    {
        $pointsHands = [];
        // $bestHand = 0;
        // $maxPoints = 0;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->checkForRule2($hands, $j, $deck);
            $handPoints = $data['points'];
            $handRule = $data['rule'];
            // if ($handPoints >= $maxPoints) {
            //     $maxPoints = $handPoints;
            //     $bestHand = $j;
            // }
            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
        }
        return [
            'points' => $pointsHands
        ];
    }

}
