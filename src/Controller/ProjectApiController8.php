<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Project\Api3;

/**
 * Contains API routes for the project
 */
class ProjectApiController8 extends AbstractController
{
    /**
     * A grid is fully filled (25 cards) and all hands (vertically and horizontally)
     * are then evaluated for rules/points
     */
    #[Route('/proj/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        Api3 $game = new Api3(),
    ): Response {
        $data = $game->results();
        return $this->json($data);
    }
}
