<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\JsonResponse;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class LibraryHandler
 */
class JsonConverterTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $converter = new JsonConverter();
        $this->assertInstanceOf("\App\Helpers\JsonConverter", $converter);
    }

    /**
     * Tests the convert method
     */
    public function testConvert(): void
    {

        $response = $this->createMock('Symfony\Component\HttpFoundation\JsonResponse');
        $convertedResponse = $this->createMock('Symfony\Component\HttpFoundation\JsonResponse');

        $response->expects($this->once())
        ->method('getEncodingOptions');

        $response->expects($this->once())
        ->method('setEncodingOptions')
        ->willReturn($convertedResponse);

        $converter = new JsonConverter();
        $res = $converter->convert($response);

        $this->assertEquals($convertedResponse, $res);
    }
}
