<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

trait GraphicTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
     * @return array<mixed>
     */
    private function slotData(int $row, int $col): array
    {
        $grid = $this->grid;
        $data = [
            'img' => "",
            'alt' => ""
        ];
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            $card = $grid[$row][$col];
            $data = [
                'img' => "img/project/cards/".$card.".svg",
                'alt' => $card
            ];
        }
        return $data;
    }

    /**
     * @return array<int,mixed>>>
     */
    public function graphic(): array
    {
        $gridGraphic = [];
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $gridGraphic[$row][$col] = $this->slotData($row, $col);
            }
        }

        return $gridGraphic;
    }
}
