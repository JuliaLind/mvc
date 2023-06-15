<?php

namespace App\ProjectGrid;

/**
 * Class representing a grid for cards
 */
class GridGraphic
{
    /**
     * @param array<array<string>> $grid
     * @return array<mixed>
     */
    private function slotData(int $row, int $col, array $grid): array
    {
        $data = [
            'img' => "",
            'alt' => ""
        ];
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            $card = $grid[$row][$col];
            $data = [
                'img' => "img/project-cards/".$card.".svg",
                'alt' => $card
            ];
        }
        return $data;
    }

    /**
     * @param array<array<string>> $grid
     * @return array<int,mixed>>>
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
