<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class Flush extends Rule implements RuleInterface
{
    use SameSuitTrait;

    /**
     * @param array<string> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        /**
         * @var array<string,array<int,int>> $uniqueCount
         */
        $uniqueCount = $this->cardCounter->count($hand);

        return $this->setSuit($uniqueCount);
    }
}
