<?php

namespace App\ProjectRules;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleStatInterface
{
    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool
     */
    public function check(array $hand, array $deck, string $card);

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool
     */
    public function check2(array $hand, array $deck);

    /**
     * @param array<string> $deck
     * @return bool
     */
    public function check3(array $deck);
}
