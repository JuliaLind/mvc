<?php

namespace App\Random;

use Datetime;

use PHPUnit\Framework\TestCase;

/**
 * To mock the builtin random function.
 * Even though the params are not used
 * they are needed to resemble the "mocked" function
 * @scrutinizer ignore-unused
 * @SuppressWarnings(PHPMD)
 */
function random_int(int $min, int $max): int
{
    return 4;
}


/**
 * Test cases for class JsonHandler.
 */
class QuoteTest extends TestCase
{
    /**
     * Tests that generateQuote method returns
     * expected Data
     */
    public function testGenerate(): void
    {
        $quote = new Quote();
        $mockedDate = new DateTime();
        $quote->generate($mockedDate);
        $exp = [
            'quote' => <<<EOD
            "Any fool can write code that a computer can understand. 
            Good programmers write code that humans can understand." — Martin Fowler
            EOD,
            'timestamp' => $mockedDate->format('Y-m-d H:i:s'),
        ];
        $res = $quote->generate();
        $this->assertEquals($exp, $res);
    }



}
