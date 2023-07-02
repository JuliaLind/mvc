<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking which rule is scored (if any)
 * for a full hand.
 */
trait CheckFullHandTrait
{
    /**
     * @var array<array<string,string|RuleInterface|RuleStatInterface|int>>
     */
    private array $rules;

    /**
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

        foreach($rules as $options) {
            /**
             * @var string $name
             */
            $name = $options['name'];
            /**
             * @var RuleInterface $rule
             */
            $rule = $options['scored'];
            if ($rule->check($hand)) {
                $result['name'] = $name;
                /**
                 * @var int $points
                 */
                $points = $options['points'];
                $result['points'] = $points;
                break;
            }
        }
        return $result;
    }
}
