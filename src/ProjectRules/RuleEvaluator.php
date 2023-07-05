<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Evaluates the highest rules scored (when the grid is full)
 * and highest possible rule(s) to score for hands that have less than 5 cards
 */
class RuleEvaluator
{
    use FinalResultsTrait;
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
