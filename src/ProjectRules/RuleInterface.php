<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleInterface
{
    /**
     * @param array<Card> $hand
     * @return array<string,string|int|bool> true if rule is fullfilled otherwise false
     */
    public function scored(array $hand);
}
