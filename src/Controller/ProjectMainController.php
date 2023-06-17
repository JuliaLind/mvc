<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Markdown\MdParser;

/**
 * The main controller class
 */
class ProjectMainController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function projLanding(
        SessionInterface $session
    ): Response {
        $user = $session->get("user") ?? null;
        $data = [
            'url' => "proj",
        ];
        // if($user === null) {
        //     return $this->render('proj/index.html.twig', $data);
        // }
        $game = $session->get("game") ?? null;
        $data = [
            ...$data,
            'user' => $user,
            'game' => $game
        ];
        return $this->render('proj/profile.html.twig', $data);
    }

    #[Route("/proj/api", name: "proj-api")]
    public function projApiLanding(): Response
    {
        $data = [
            'url' => "api"
        ];
        return $this->render('proj/api.html.twig', $data);
    }

    #[Route("/proj/about", name: "proj-about")]
    public function projAbout(): Response
    {
        $data = [
            'url' => "about"
        ];
        return $this->render('proj/api.html.twig', $data);
    }

    #[Route("/proj/rules", name: "proj-rules")]
    public function projRules(): Response
    {
        $data = [
            'url' => "rules"
        ];
        return $this->render('proj/rules.html.twig', $data);
    }
}
