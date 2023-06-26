<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class TwoPairs extends Rule implements RuleInterface
{
    use TwoPairsTrait;
    /**
     * @param array<string> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        return $this->check3($hand);
    }
}
