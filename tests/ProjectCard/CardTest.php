<?php

namespace App\ProjectCard;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    public function testCreateObject(): void
    {
        $card = new Card(14, "S");
        $this->assertInstanceOf("\App\ProjectCard\Card", $card);

        $res = $card->getRank();
        $exp = 14;
        $this->assertEquals($exp, $res);

        $res = $card->getSuit();
        $exp = "S";
        $this->assertEquals($exp, $res);

        // $res = $card->getName();
        // $exp = "14S";
        // $this->assertEquals($exp, $res);

        $res = $card->graphic();
        $exp = [
            'img' => "img/project-cards/14S.svg",
            'alt' => "14S"
        ];
        $this->assertEquals($exp, $res);
    }
}
