<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Project\ApiGame2;

/**
 * Controller class related to the Project. Contains the
 * API route for placing a card into an empty grid
 */
class ProjectApiController4 extends AbstractController
{
    /**
     * Card is placed in a new grid in slot (row/column) that have been passed as params
     */
    #[Route('/proj/api/place-card/{row<\d+>}/{col<\d+>}', name: "api-place-card", methods: ['POST'])]
    public function apiPlaceCard(
        int $row,
        int $col,
        ApiGame2 $game = new ApiGame2(),
    ): Response {
        $data = $game->oneRound($row, $col);
        return $this->json($data);
    }
}
