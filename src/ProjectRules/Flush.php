<?php

namespace App\ProjectRules;

class Flush implements RuleInterface
{
    use AdditionalValueTrait;
    use CountBySuitTrait;
    use FirstCheckTrait;
    use FlushTrait;
    use FlushTrait2;
    use FlushTrait3;
    use RuleDataTrait;
    use SameSuitTrait;

    public function __construct()
    {
        $this->name = "Flush";
        $this->points = 20;
    }

    /**
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        $suitCount = $this->countBySuit($hand);

        return count($suitCount) === 1;
    }
}
