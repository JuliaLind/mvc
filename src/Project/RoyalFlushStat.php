<?php

namespace App\Project;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlushStat implements RuleStatInterface
{
    use RoyalFlushTrait;

    private CardSearcher $searcher;

    public function __construct(
        CardCounter $cardCounter = new CardCounter(),
        CardSearcher $searcher = new CardSearcher()
    ) {
        $this->cardCounter = $cardCounter;
        $this->searcher = $searcher;
    }

    /**
     * @param array<Card> $hand
     */
    public function checkForScore($hand): bool
    {
        $rule = new RoyalFlush();
        $scored =  $rule->scored($hand);
        /**
         * @var bool $possible
         */
        $possible = $scored['scored'];
        return $possible;
    }

    /**
     * @param array<Card> $cards
     * @param string $suit
     */
    protected function checkForCards($cards, $suit): bool
    {
        $possible = true;
        $searcher = $this->searcher;
        for ($rank = self::MINRANK; $rank <= self::MAXRANK; $rank++) {
            $possible = $searcher->search($cards, $rank, $suit);
            if ($possible == false) {
                break;
            }
        }
        return $possible;
    }

    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function possible(array $hand, array $deck, Card $card): bool
    {
        if (count($hand) === 5) {
            return false;
        }
        $newHand = [
            ...$hand,
            $card
        ];
        if (count($newHand) === 5) {
            return $this->checkForScore($newHand);
        }

        $uniqueCountHand = $this->cardCounter->count($newHand);
        /**
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (count($suitsHand) > self::UNIQUESUITS || min(array_keys($ranksHand)) < self::MINRANK) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $allCards = array_merge($newHand, $deck);
        // $possible = true;
        // for ($rank = self::MINRANK; $rank <= self::MAXRANK; $rank++) {
        //     $possible = $searcher->search($allCards, $rank, $suit);
        //     if ($possible == false) {
        //         break;
        //     }
        // }
        return $this->checkForCards($allCards, $suit);
    }
}
