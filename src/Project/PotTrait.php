<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Contains the pot and method for
 * adding money to the pot
 */
trait PotTrait
{
    /**
     * Contains the money the player has bet in the current game
     */
    private int $pot = 0;

    /**
     * Sets the pot to the amount that has been
     * passed as argument.
     */
    public function setPot(int $amount): void
    {
        $this->pot = $amount;
    }
}
