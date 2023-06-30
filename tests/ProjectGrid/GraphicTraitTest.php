<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class GraphicTraitTest extends TestCase
{
    use GraphicTrait;


    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * This "mock"-version of abstract method will registers the params it has
     * been called with to the "calledWithParams-attrib" so we can ensure
     * that the method is called from the graphic()-method as intended,
     * returns the params it was called with (as strings) instead of actual data
     * @return array<string,string>
     */
    private function slotGraphic(int $row, int $col): array
    {
        return [
            'img' => strval($row),
            'alt' => strval($col),
        ];
    }

    public function testGraphic(): void
    {
        $exp = [];
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $exp[$row][$col] = [
                    'img' => strval($row),
                    'alt' => strval($col)
                ];
            }
        }
        $res = $this->graphic();
        $this->assertEquals($exp, $res);
    }
}
