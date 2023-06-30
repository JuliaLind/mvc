<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class SlotGraphicTraitTest extends TestCase
{
    use SlotGraphicTrait;

    public function testSlotGraphic(): void
    {

        $res = $this->slotGraphic(3, 2);
        $exp = [
            'img' => "",
            'alt' => ""
        ];
        $this->assertEquals($exp, $res);

        $this->grid[3][2] = "12C";
        $res = $this->slotGraphic(3, 2);
        $exp = [
            'img' => "img/project/cards/12C.svg",
            'alt' => "12C"
        ];
        $this->assertEquals($exp, $res);

        $res = $this->slotGraphic(3, 3);
        $exp = [
            'img' => "",
            'alt' => ""
        ];
        $this->assertEquals($exp, $res);

        $res = $this->slotGraphic(4, 1);
        $exp = [
            'img' => "",
            'alt' => ""
        ];
        $this->assertEquals($exp, $res);
    }

}
