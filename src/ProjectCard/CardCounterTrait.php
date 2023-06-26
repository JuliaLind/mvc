<?php

namespace App\ProjectCard;

trait CardCounterTrait
{
    /**
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    public function groupBySuit($cards): array
    {
        $data = [
            'D' => [],
            'H' => [],
            'C' => [],
            'S' => []
        ];
        foreach($cards as $card) {
            $data[$card[-1]][] = intval(substr($card, 0, -1));
        }
        return $data;
    }
}
