<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

trait PotTrait
{
    private int $pot=0;

    public function setPot(int $amount): void
    {
        $this->pot = $amount;
    }
}
