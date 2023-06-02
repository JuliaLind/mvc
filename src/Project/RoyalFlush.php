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

    // /**
    //  * @var int $MAXRANK corresponds to Ace
    //  */
    // private const MAXRANK = 14;

    // /**
    //  * @var int $MINRANK corresponds to Ten
    //  */
    // private const MINRANK = 10;

    // /**
    //  * @var int $UNIQUESUITS
    //  */
    // private const UNIQUESUITS = 1;

    // private CardCounter $cardCounter;

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
    //  * @param array<Card> $hand
    //  * @param array<Card> $deck
    //  * @param Card $card
    //  * @return bool true if rule is still possible given passed value
    //  * otherwise false
    //  */
    // public function possible(array $hand, array $deck, Card $card, CardSearcher $searcher = new CardSearcher()): bool
    // {
    //     if (count($hand) === 5) {
    //         return false;
    //     }
    //     $newHand = [
    //         ...$hand,
    //         $card
    //     ];
    //     if (count($newHand) === 5) {
    //         $scored =  $this->scored($newHand);
    //         /**
    //          * @var bool $possible
    //          */
    //         $possible = $scored['scored'];
    //         return $possible;
    //     }

    //     if (count($hand == 0)) {
    //         $possible = false;
    //         $spades = 0;
    //         $cloves = 0;
    //         $diamonds = 0;
    //         $hearts = 0;
    //         for ($rank = 10; $rank <= 14; $rank++) {
    //             if ($searcher->search($deck, $rank, "S") == true) {
    //                 $spades +=1;
    //             }
    //             if ($searcher->search($deck, $rank, "C") == true) {
    //                 $cloves +=1;
    //             }
    //             if ($searcher->search($deck, $rank, "D") == true) {
    //                 $diamonds +=1;
    //             }
    //             if ($searcher->search($deck, $rank, "H") == true) {
    //                 $hearts +=1;
    //             }
    //         }
    //         if (in_array(5, [$spades, $cloves, $diamonds, $hearts])) {
    //             $possible = true;
    //         }
    //         return $possible;
    //     }


    //     $uniqueCountHand = $this->cardCounter->count($newHand);
    //     /**
    //      * @var array<string,int> $suitsHand
    //      */
    //     $suitsHand = $uniqueCountHand['suits'];
    //     /**
    //      * @var array<int,int> $ranksHand
    //      */
    //     $ranksHand = $uniqueCountHand['ranks'];

    //     if (count($suitsHand) > self::UNIQUESUITS || min(array_keys($ranksHand)) < self::MINRANK) {
    //         return false;
    //     }

    //     $suit = array_keys($suitsHand)[0];

    //     $allCards = $hand + $deck;
    //     $possible = true;
    //     for ($rank = self::MINRANK; $rank <= self::MAXRANK; $rank++) {
    //         $possible = $searcher->search($allCards, $rank, $suit);
    //         if ($possible == false) {
    //             break;
    //         }
    //     }
    //     return $possible;
    // }
}
