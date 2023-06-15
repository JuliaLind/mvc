<?php

namespace App\ProjectRules;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleInterface
{
    /**
     * @param array<string> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand);
}
