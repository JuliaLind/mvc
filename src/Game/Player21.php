<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Class representing a Player in the 21 game
 */
class Player21
{
    use PlayerTrait;

    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;
    protected int $money=0;

    /**
     * Constructor
     * @param string $name - Name of the player, defaults to 'You'
     */
    public function __construct(string $name="You", CardHand $hand=new CardHand())
    {
        $this->name = $name;
        $this->hand = $hand;
    }

    /**
     * Getter of the amount of money the player currently has
     *
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

        /**
     * Increases player's money
     *
     * @param int $money the amount of money to add
     * @return void
     */
    public function incrMoney(int $money): void
    {
        $this->money += $money;
    }

    /**
     * Decreases player's money and returns the corresponding amount
     *
     * @return int the amount of money that was substracted
     */
    public function decrMoney(int $money): int
    {
        $this->money -= $money;
        return $money;
    }

    /**
     * Adjusts if ace should be valued at 14 or at 1
     */
    protected function adjAceValue(int $pointSum, int $value): int
    {
        if ($value === 14 && $pointSum + $value > self::GOAL) {
            $value = 1;
        }
        return $value;
    }

    /**
     * Adjusts ace-value to 1
     */
    protected function adjAceValueToOne(int $value): int
    {
        if ($value === 14) {
            $value = 1;
        }
        return $value;
    }

    /**
     * Returns the current hand value.
     * Ace is valued as 14 unless the hand value
     * is above 21, then ace is valued at 1. Each
     * ace is valued separately
     *
     * @return int
     */
    public function handValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            $pointSum += $this->adjAceValue($pointSum, $value);
        }
        return $pointSum;
    }

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
    public function estimateRisk(DeckOfCards $deck): float
    {
        $minHandValue = $this->minHandValue();
        $cardsLeft = $deck->getCardCount();
        $possibleCards = $deck->getValues();
        $badCards = 0;
        $risk = 0;
        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($minHandValue + $value > self::GOAL) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }
        return $risk;
    }
}
