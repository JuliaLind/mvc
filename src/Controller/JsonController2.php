<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JsonController2 extends AbstractController
{
    /**
     * Displays a randomly selected quote and date+time when the selection
     * took place
     */
    #[Route('/api/quote', name: "quote")]
    public function jsonQuote(
        Quote $quote = new Quote(),
    ): Response {
        date_default_timezone_set('Europe/Stockholm');
        $data = $quote->generate();
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
