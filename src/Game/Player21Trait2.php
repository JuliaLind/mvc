<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Trate for estimating the risk of getting fat in the 21 game, from kmom03-04
 */
trait Player21Trait2
{
    protected CardHand $hand;

    /**
     * Adjusts ace-value to 1
     */
    abstract protected function adjAceValueToOne(int $value): int;

    /**
     * Returns the current min hand value.
     * Used for calculating risk for getting fat
     * Ace is always valued at 1
     *
     * @return int
     */
    public function minHandValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            $pointSum += $this->adjAceValueToOne($value);
        }
        return $pointSum;
    }

    /**
     * Returns the risk of current player getting
     * above 21 with next drawn card
     * @return float the risk of getting "fat" with next card 0-1
     */
    public function estimateRisk(DeckOfCards $deck, ValueConverter2 $converter = new ValueConverter2()): float
    {
        $minHandValue = $this->minHandValue();
        $cardsLeft = $deck->getCardCount();
        $possibleCards = $deck->getValues();
        $badCards = 0;
        $risk = 0;
        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                $value = $this->adjAceValueToOne($value);
                $badCards += $converter->checkIfBad($minHandValue, $value);
            }
            $risk = $badCards / $cardsLeft;
        }
        return $risk;
    }
}
