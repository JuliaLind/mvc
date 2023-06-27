<?php

namespace App\ProjectRules;

class FullHouseStat extends Rule implements RuleStatInterface
{
    use FullHouseStatTrait2;
    use FullHouseStatTrait3;
    use FullHouseStatTrait4;
    use FullHouseStatTrait5;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        return $this->check2($newHand, $deck);
    }
}
