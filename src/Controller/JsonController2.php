<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\JsonConverter;
use App\Helpers\JsonHandler2;

/**
 * Controller for json routes
 */
class JsonController2 extends AbstractController
{
    /**
     * Displays a randomly selected quote and date+time when the selection
     * took place
     */
    #[Route('/api/quote', name: "quote")]
    public function jsonQuote(
        JsonHandler2 $handler = new JsonHandler2(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        date_default_timezone_set('Europe/Stockholm');
        $data = $handler->generateQuote();
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
