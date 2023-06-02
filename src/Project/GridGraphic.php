<?php

namespace App\Project;

/**
 * Class representing a grid for cards
 */
class GridGraphic
{
    /**
     * @param array<array<Card>> $grid
     * @return array<string,bool|string>
     */
    private function slotData(int $row, int $col, array $grid): array
    {
        $data = [
            'filled' => false,
            'img' => "",
            'alt' => ""
        ];
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            $card = $grid[$row][$col]->graphic();
            $data = [
                'filled' => true,
                ...$card,
            ];
        }
        return $data;
    }

    /**
     * @param array<array<Card>> $grid
     * @return  array<int,array<int,array<string,bool|string>>>
     */
    public function graphic($grid): array
    {
        $gridGraphic = [];
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $gridGraphic[$row][$col] = $this->slotData($row, $col, $grid);
            }
        }

        return $gridGraphic;
    }
}
