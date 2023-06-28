<?php

namespace App\ProjectRules;

class TwoPairs extends Rule implements RuleInterface
{
    use TwoPairsTrait;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        return $this->check3($hand);
    }
}
