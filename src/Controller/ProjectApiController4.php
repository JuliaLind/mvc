<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Helpers\JsonConverter;
use App\Project\Api2;

/**
 * Contains API routes for the project
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
        Api2 $game = new Api2(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $data = $game->oneRound($row, $col);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}