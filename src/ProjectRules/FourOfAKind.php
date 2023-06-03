<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class FourOfAKind implements RuleInterface
{
    use RuleTrait;

    /**
     * @var int $POINTS the points if rule is  scored
     */
    private const POINTS = 50;

    /**
     * @var string $NAME name of the rule
     */
    private const NAME = "Four Of A Kind";

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }


    /**
     * @param array<Card> $hand
     * @return array<string,string|int|bool> name, points and true if rule is fullfilled otherwise false
     */
    public function scored(array $hand): array
    {
        $data = [
            'name' => self::NAME,
            'points' => self::POINTS,
            'scored' => false
        ];
        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        if (max($uniqueRanks) >= 4) {
            $data['scored'] = true;
        }
        return $data;
    }
}
