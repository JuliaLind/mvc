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
    use Player21Trait;
    use Player21Trait2;
    use Player21Trait3;

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
}
