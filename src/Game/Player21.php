<?php

namespace App\Game;

class Player21 extends Player
{
    /**
     * @var string $type Bank or player
     */
    protected string $type;

    public function __construct(string $name="You", string $type="player")
    {
        parent::__construct($name);
        $this->type = $type;
    }

    public function handValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            if ($value === 14 && $pointSum + $value > 21) {
                $value = 1;
            }
            $pointSum += $value;
        }
        return $pointSum;
    }

    public function minHandValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            if ($value === 14) {
                $value = 1;
            }
            $pointSum += $value;
        }
        return $pointSum;
    }


    /**
     * Returns type of player - bank or player
     *
     * @return string
     */    
    public function getType(): string
    {
        return $this->type;
    }
}
