<?php

namespace App\Project;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlush implements RuleInterface
{
    use RoyalFlushTrait;
    /**
     * @var int $POINTS the points if rule is  scored
     */
    private const POINTS = 100;

    /**
     * @var string $NAME name of the rule
     */
    private const NAME = "Royal Flush";

    /**
     * @var int $UNIQUERANKS
     */
    private const UNIQUERANKS = 5;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }

    /**
     * @param array<int,int> $uniqueRanks
     * @return bool true if rule is fullfilled otherwise false
     */
    private function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));
        if ($maxRank === self::MAXRANK && $minRank === self::MINRANK) {
            return true;
        }
        return false;
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
         * @var array<string,int> $uniqueSuits
         */
        $uniqueSuits = $uniqueCount['suits'];
        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        if (count($uniqueSuits) === self::UNIQUESUITS && count($uniqueRanks) === self::UNIQUERANKS) {
            $data['scored'] = $this->evaluateRanks($uniqueRanks);
        }
        return $data;
    }
}
