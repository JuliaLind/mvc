<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\JsonConverter;

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
}
