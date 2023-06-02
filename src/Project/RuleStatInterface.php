<?php

namespace App\Project;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleStatInterface
{
    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function possible(array $hand, array $deck, Card $card);
}
