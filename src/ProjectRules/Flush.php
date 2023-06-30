<?php

namespace App\ProjectRules;

class Flush implements RuleInterface
{
    use CountBySuitTrait;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        $suitCount = $this->countBySuit($hand);

        return count($suitCount) === 1;
    }
}
