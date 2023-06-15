<?php

namespace App\ProjectRules;

use App\ProjectCard\EmptyCellFinder;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RuleStats
{
    /**
     * @var array<array<string,string|RuleStatInterface>>
     */
    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            [
                'name' => 'Royal Flush',
                'possible' => new RoyalFlushStat()
            ],
            [
                'name' => 'Straight Flush',
                'possible' => new StraightFlushStat()
            ],
            [
                'name' => 'Four Of A Kind',
                'possible' => new SameOfAKindStat(4)
            ],
            [
                'name' => 'Full House',
                'possible' => new FullHouseStat()
            ],
            [
                'name' => 'Flush',
                'possible' => new FlushStat()
            ],
            [
                'name' => 'Straight',
                'possible' => new StraightStat()
            ],
            [
                'name' => 'Three Of A Kind',
                'possible' => new SameOfAKindStat(3)
            ],
            [
                'name' => 'Two Pairs',
                'possible' => new TwoPairsStat()
            ],
            [
                'name' => 'One Pair',
                'possible' => new SameOfAKindStat(2)
            ],
        ];
    }

    /**
     * @return array<array<string,string|RuleStatInterface>>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array<array<string,string|RuleStatInterface>> $rules
     */
    public function setRules($rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @param int $ruleNr
     * @param array<array<string>> $rows
     * @param array<string> $deck
     */
    public function checkSingle($rows, int $rowNr, $deck, string $card, $ruleNr): bool
    {
        if (array_key_exists($rowNr, $rows) && count($rows[$rowNr]) < 5) {
            $hand = $rows[$rowNr];
            $rules = $this->rules;
            $rule = $rules[$ruleNr];
            /**
             * @var RuleStatInterface $possible
             */
            $possible = $rule['possible'];
            return ($possible->check($hand, $deck, $card));
        }
        return false;
    }
}
