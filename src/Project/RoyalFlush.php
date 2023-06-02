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

    // /**
    //  * @param array<mixed> $data
    //  * @return bool true if rule is still possible given passed value
    //  * otherwise false
    //  */
    // public function possible(array $hand, array $deck, Card $card): bool
    // {
    //     $data = [
    //         'name' => self::NAME,
    //         'points' => self::POINTS,
    //         'possible' => false
    //     ];
    //     $cardCountHand = count($hand);
    //     if ($cardCountHand === 5) {
    //         return $data;
    //     }
    //     $uniqueCountHand = $this->cardCounter->count($hand);
    //     $uniqueCountDeck = $this->cardCounter->count($deck);
    //     /**
    //      * @var array<string,int> $suitsHand
    //      */
    //     $suitsHand = $uniqueCountHand['suits'];
    //     /**
    //      * @var array<int,int> $ranksHand
    //      */
    //     $ranksHand = $uniqueCountHand['ranks'];
    //     /**
    //      * @var array<string,int> $suitsHand
    //      */
    //     $suitsDeck = $uniqueCountDeck['suits'];
    //     /**
    //      * @var array<int,int> $ranksHand
    //      */
    //     $ranksDeck = $uniqueCountDeck['ranks'];


    // }
}
