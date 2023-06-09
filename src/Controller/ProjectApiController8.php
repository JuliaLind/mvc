<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Project\ApiGame3;
use App\Project\Deck;

/**
 * Controller class related to the Project. Contains route where
 * a fully filled Grid and the results of all ten hands are displayed as Json
 */
class ProjectApiController8 extends AbstractController
{
    /**
     * A grid is fully filled (25 cards) and all hands (vertically and horizontally)
     * are then evaluated for rules/points
     */
    #[Route('/proj/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        ApiGame3 $game = new ApiGame3(),
        Deck $deck = new Deck()
    ): Response {
        $data = $game->results($deck);
        return $this->json($data);
    }
}
