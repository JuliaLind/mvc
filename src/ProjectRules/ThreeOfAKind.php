<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class ThreeOfAKind implements RuleInterface
{
    use RuleTrait;
    use SameRankTrait;

    // /**
    //  * @var int $points the points if rule is  scored
    //  */
    // private int $points = 10;

    // /**
    //  * @var string $name name of the rule
    //  */
    // private string $name = "Three Of A Kind";

    // /**
    //  * @var int $minCountRank the minimum number of cards of
    //  * same rank required to score the rule
    //  */
    // private int $minCountRank = 3;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
        $this->points = 10;
        $this->name = "Three Of A Kind";
        $this->minCountRank = 3;
    }


    // /**
    //  * @param array<Card> $hand
    //  * @return array<string,string|int|bool> name, points and true if rule is fullfilled otherwise false
    //  */
    // public function scored(array $hand): array
    // {
    //     $data = [
    //         'name' => self::NAME,
    //         'points' => self::POINTS,
    //         'scored' => false
    //     ];
    //     $uniqueCount = $this->cardCounter->count($hand);

    //     /**
    //      * @var array<int,int> $uniqueRanks
    //      */
    //     $uniqueRanks = $uniqueCount['ranks'];

    //     if (max($uniqueRanks) >= 3) {
    //         $data['scored'] = true;
    //     }
    //     return $data;
    // }
}
