<?php

namespace App\ProjectRules;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleInterface
{
    /**
     * Returns true if the rule is scored,
     * otherwise false. Starting position is that none
     * of the higher rules has been scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool;
}
