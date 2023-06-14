<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectGameController extends AbstractController
{
    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/index.html.twig', $data);
    }

    #[Route("/proj/init", name: "proj-init")]
    public function projInit(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/index.html.twig', $data);
    }
}
