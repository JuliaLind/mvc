<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class Flush extends Rule implements RuleInterface
{
    use SameSuitTrait;

    /**
     * @param array<Card> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        /**
         * @var array<string,array<int,int>> $uniqueCount
         */
        $uniqueCount = $this->cardCounter->count($hand);

        return $this->setSuit($uniqueCount);
        // /**
        //  * @var array<string,int> $uniqueSuits
        //  */
        // $uniqueSuits = $uniqueCount['suits'];

        // if (count($uniqueSuits) > 1) {
        //     return false;
        // }
        // return true;
    }
}
