<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RowsToColsTraitTest extends TestCase
{
    use RowsToColsTrait;

    public function testGetCols(): void
    {
        $rows = [
            1 => [1 => "7C"                      ],
            3 => [          2 => "12C", 3 => "6C"],
            4 => [          2 => "5C"            ]
        ];
        $exp = [
            1 => [1 => "7C"],
            2 => [3 => "12C", 4 => "5C"],
            3 => [3 => "6C"]
        ];
        $this->assertSame($exp, $this->getCols($rows));

        $rows = [];
        $this->assertSame([], $this->getCols($rows));
    }

    public function testGetCols2(): void
    {
        $rows = [
            0 => [0 => "2H", 1 => "14S", 2 => "2S",           4 => "4C"],
            1 => [           1 => "5D",             3 => "13C"         ],
            2 => [                                  3 => "13D"         ],
            4 => [0 => "13H"                                           ]
        ];

        $exp = [
            0 => [0 => "2H",                                 4 => "13H"],
            1 => [0 => "14S", 1 => "5D"                                ],
            2 => [0 => "2S"                                            ],
            3 => [            1 => "13C", 2 => "13D"                   ],
            4 => [0 => "4C"                                            ]
        ];

        $this->assertEquals($exp, $this->getCols($rows));
    }
}
