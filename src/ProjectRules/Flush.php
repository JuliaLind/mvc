<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class Flush implements RuleInterface
{
    use SameSuitTrait;

    protected CardCounter $cardCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }

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
