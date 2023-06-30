<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

trait CheckFullHandTrait
{
    /**
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
