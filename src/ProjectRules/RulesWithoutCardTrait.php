<?php

namespace App\ProjectRules;

trait RulesWithoutCardTrait
{
    /**
     * From CheckWithoutCardTrait
     *
     * Checks one hand for the highest possible rule that can be scored
     * without the dealt card
     * @param array<array<string>> $hands
     * @param array<string> $deck
     */
    abstract private function handRuleWithout(array $hands, int $index, array $deck): string;

    /**
     * Returns an array of associative arrays containing name of the highest possible rule
     * than can be scored in each hand without the dealt card
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<int,string>
     */
    private function rulesWithoutCard(array $hands, array $deck): array
    {
        $rulesHands = [];

        for ($j = 0; $j <= 4; $j++) {
            $rulesHands[$j] = $this->handRuleWithout($hands, $j, $deck);
        }
        return $rulesHands;
    }

}
