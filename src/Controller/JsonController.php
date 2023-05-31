<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\JsonConverter;


use Symfony\Component\HttpFoundation\Request;
use App\Helpers\JsonHandler;

/**
 * Controller for json routes
 */
class JsonController extends AbstractController
{
    /**
     * Contains links to and descriptions of all json routes
     */
    #[Route("/api", name: "api")]
    public function apis(
        JsonHandler $handler = new JsonHandler()
    ): Response {
        $data = $handler->getLandingData();
        return $this->render('landing_json.html.twig', $data);
    }

    /**
     * Displays a randomly selected quote and date+time when the selection
     * took place
     */
    #[Route('/api/quote', name: "quote")]
    public function jsonQuote(
        JsonHandler $handler = new JsonHandler(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        date_default_timezone_set('Europe/Stockholm');
        $data = $handler->generateQuote();
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
