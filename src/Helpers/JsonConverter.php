<?php

namespace App\Helpers;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Helper class to handle the routes in MainController
 */
class JsonConverter
{
    /**
     * @return JsonResponse
     */
    public function convert(JsonResponse $response): JsonResponse
    {
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
