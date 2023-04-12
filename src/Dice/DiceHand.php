<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    /**
     * @var array<Dice|null> $hand The hand holding the dice.
     */
    private array $hand = [];

    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    public function roll(): void
    {
        foreach ($this->hand as $die) {
            if ($die) {
                $die->roll();
            }
        }
    }

    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    /**
     * Returns array with integer values of dice.
     *
     * @return array<mixed>
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            if ($die) {
                $values[] = $die->getValue();
            }
        }
        return $values;
    }

    /**
     * Returns array with string representation of dice.
     *
     * @return array<string>
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            if ($die) {
                $values[] = $die->getAsString();
            }
        }
        return $values;
    }
}
