<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\CardLandingHandler;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for routes where cards are displayed
 */
class CardLandingController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(
        CardLandingHandler $cardHandler=new CardLandingHandler()
    ): Response {
        $data = $cardHandler->getMainData();
        return $this->render('card/home.html.twig', $data);
    }
}
