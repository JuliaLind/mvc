<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class FullHouseStat implements RuleStatInterface
{
    use FullHouseStatTrait2;
    use FullHouseStatTrait3;
    use FullHouseStatTrait4;
    use FullHouseStatTrait5;
    use FullHouseStatTrait8;

    protected CardCounter $cardCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }
}
