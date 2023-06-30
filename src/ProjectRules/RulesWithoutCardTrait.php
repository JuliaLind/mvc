<?php

namespace App\ProjectRules;

trait RulesWithoutCardTrait
{
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     */
    abstract private function handRuleWithout(array $hands, int $index, array $deck): string;

    /**
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
