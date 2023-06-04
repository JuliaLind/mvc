<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait SameRankTrait
{
    protected CardCounter $cardCounter;

    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    protected int $minCountRank;

    /**
    * @var int $points the points if rule is scored
    */
    protected int $points;

    /**
     * @var string $name name of the rule
     */
    protected string $name;

    /**
     * @param array<Card> $hand
     * @return array<string,string|int|bool> name, points and true if rule is fullfilled otherwise false
     */
    public function scored(array $hand): array
    {
        $data = [
            'name' => $this->name,
            'points' => $this->points,
            'scored' => false
        ];
        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        if (max($uniqueRanks) >= $this->minCountRank) {
            $data['scored'] = true;
        }
        return $data;
    }
}
