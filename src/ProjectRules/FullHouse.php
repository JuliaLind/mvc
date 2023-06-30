<?php

namespace App\ProjectRules;

class FullHouse implements RuleInterface
{
    use CountByRankTrait;
    use FullHouseTrait;
}
