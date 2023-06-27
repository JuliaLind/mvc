<?php

namespace App\ProjectRules;

class Flush extends Rule implements RuleInterface
{
    use SameSuitTrait;

    /**
     * @param array<string> $hand
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
