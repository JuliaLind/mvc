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
        if ($maxRank === 14 && $minRank === 10) {
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
        if (count($uniqueRanks) === 5 && count($uniqueSuits) === 1) {
            $data['scored'] = $this->evaluateRanks($uniqueRanks);
            // return $this->evaluateRanks($uniqueRanks);
        }
        return $data;
    }

    // /**
    //  * @return int points
    //  */
    // public function getPoints(): int
    // {
    //     return self::POINTS;
    // }

    // /**
    //  * @return string name of the rule
    //  */
    // public function getName(): string
    // {
    //     return self::NAME;
    // }

    // /**
    //  * @param array<mixed> $data
    //  * @return bool true if rule is still possible given passed value
    //  * otherwise false
    //  */
    // public function possible(array $data, Card $card): bool
    // {

    // }
}
