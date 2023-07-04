<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Evaluates the highest rules scored (when the grid is full)
 * and highest possible rule(s) to score for hands that have less than 5 cards
 */
class RuleEvaluator
{
    use BestPossibleRulesTrait;
    use EmptyCellTrait;
    use FinalResultsTrait;
    use ExtractRuleNamesTrait;
    use CheckEmptyGridTrait;
    use CheckFullHandTrait;
    use CheckWithCardTrait;
    use CheckWithoutCardTrait;
    use PointsAndRuleNameTrait;
    use PointsAndRuleNameTrait2;
    use RuleNameTrait;
    use RuleNameTrait2;
    // use RulesWithCardTrait;
    // use RulesWithoutCardTrait;
    use SlotTrait;
    use SuggestionTrait;

    /**
     * @var array<RuleInterface> $rules
     */
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            new RoyalFlush(),
            new StraightFlush(),
            new SameOfAKind(4),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
    }
}
