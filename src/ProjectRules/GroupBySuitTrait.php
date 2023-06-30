<?php

namespace App\ProjectRules;

trait GroupBySuitTrait
{
    /**
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    private function groupBySuit($cards): array
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
