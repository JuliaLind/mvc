<?php

namespace App\Project;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlush implements RuleInterface
{
    /**
     * @var int $POINTS the points if rule is  scored
     */
    private const POINTS = 100;

    /**
     * @var string $NAME name of the rule
     */
    private const NAME = "Royal Flush";

    /**
     * @var int $MAXRANK corresponds to Ace
     */
    private const MAXRANK = 14;

    /**
     * @var int $MINRANK corresponds to Ten
     */
    private const MINRANK = 10;

    /**
     * @var int $UNIQUERANKS 
     */
    private const UNIQUERANKS = 5;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    private CardCounter $cardCounter;
    private SuitCounter $suitCounter;
    private RankCounter $rankCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter(),
        SuitCounter $suitCounter = new SuitCounter(),
        RankCounter $rankCounter = new RankCounter()
    ) {
        $this->cardCounter = $cardCounter;
        $this->suitCounter = $suitCounter;
        $this->rankCounter = $rankCounter;
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
        $cardCount = $this->cardCounter->cardCount($hand);
        if ($cardCount < 5) {
            return $data;
        }
        $uniqueSuits = $this->suitCounter->suits($hand);
        $uniqueRanks = $this->rankCounter->ranks($hand);
        $cardCount = $this->cardCounter->cardCount($hand);
        if (count($uniqueRanks) === self::UNIQUERANKS && count($uniqueSuits) === self::UNIQUESUITS) {
            $data['scored'] = $this->evaluateRanks($uniqueRanks);
            // return $this->evaluateRanks($uniqueRanks);
        }
        return $data;
    }

    // /**
    //  * @param array<mixed> $data
    //  * @return bool true if rule is still possible given passed value
    //  * otherwise false
    //  */
    // public function possible(array $data, Card $card): bool
    // {

    // }
}
