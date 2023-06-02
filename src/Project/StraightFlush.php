<?php

namespace App\Project;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class StraightFlush implements RuleInterface
{
    use FlushTrait;
    use RuleTrait;
    use StraightTrait;

    /**
     * @var int $POINTS the points if rule is  scored
     */
    private const POINTS = 75;

    /**
     * @var string $NAME name of the rule
     */
    private const NAME = "Straight Flush";

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }

    /**
     * @param array<int,int> $uniqueRanks
     * @return bool
     */
    private function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));
        $diff = $maxRank - $minRank;
        if ($diff === self::UNIQUERANKS - 1) {
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