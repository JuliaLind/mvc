<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking which rule is scored (if any)
 * for a full hand.
 */
trait CheckFullHandTrait
{
    /**
     * @var array<RuleInterface> $rules
     */
    private array $rules;

    /**
     * Used in FinalResultsTrait
     *
     * Checks which rule is scored at best (if any)
     * for a full hand. Called when the grid is completely filled.
     * Returns name of the scored rule and the number of poitns (actual, not weighted/adjusted)
     * @param array<string> $hand
     * @return array<string,string|int>
     */
    private function checkHandForWin($hand): array
    {
        $rules = $this->rules;
        $result = [];

        $result['name'] = 'None';
        $result['points'] = 0;

        foreach($rules as $rule) {
            if ($rule->scored($hand)) {
                $result['name'] = $rule->getName();
                $result['points'] = $rule->getPoints();
                break;
            }
        }
        return $result;
    }
}
