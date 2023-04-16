<?php

namespace App\Game;

class Player21 extends Player
{
    public function getPoints(): int
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

    public function getMinPoints(): int
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
}
