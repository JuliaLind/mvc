<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;
use App\ProjectRules\RoyalFlush;
use App\ProjectRules\StraightFlush;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\Straight;
use App\ProjectRules\TwoPairs;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Evaluates the highest rules scored (when the grid is full)
 * and highest possible rule(s) to score for hands that have less than 5 cards
 */
class RuleEvaluator
{
    use FinalResultsTrait;
    use SuggestionTrait;
    use RowsToColsTrait;

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

    /**
     * For testing purposes
     * @return array<RuleInterface> $rules
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
