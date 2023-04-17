<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

// use Anax\TextFilter\TextFilter;
use App\Markdown\MdParser;

class MainController extends AbstractController
{
    #[Route("/", name: "home")]
    public function home(): Response
    {
        $filename = "markdown/home.md";
        $parsedText = new MdParser($filename);
        $data = [
            'home' => $parsedText->getParsedText(),
            'page' => "home",
            'url' => "/",
        ];
        return $this->render('home.html.twig', $data);
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        $filename = "markdown/about.md";
        $parsedText = new MdParser($filename);
        $data = [
            'about' => $parsedText->getParsedText(),
            'page' => "about",
            'url' => "/about",
        ];
        return $this->render('about.html.twig', $data);
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        $data = [
            'page' => "report",
            'url' => "/report",
        ];
        for ($i = 1; $i <= 7; $i++) {
            $filename = "markdown/kmom0{$i}.md";
            $parsedText = new MdParser($filename);
            $data["kmom0{$i}"] = $parsedText->getParsedText();
        }

        return $this->render('report.html.twig', $data);
    }

    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $top = random_int(3, 25);
        $left = random_int(1, 80);

        $monkey = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: {$left}%; margin-top: {$top}%;" alt="apa">
        EOD;

        $data = [
            'number' => $number,
            'page' => "lucky",
            'monkey' => $monkey,
            'url' => "/lucky",
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function apis(): Response
    {
        $data = [
            'page' => "landing",
            'url' => "/api",
            'jsonRoutes' => [
                [
                    'link' => "quote",
                    'descr' => "Displays a motivational quote and date and time the site was rendered",
                    'method' => '',
                ],
                [
                    'link' => "jsonDeck",
                    'descr' => "Displays a json-text representation of all cards in deck sorted by color and value",
                    'method' => '',
                ],
                [
                    'link' => "jsonShuffle",
                    'descr' => "Post route that returnes a shuffled json-text representation of all cards in deck",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDraw",
                    'descr' => "Post route that 'draws' and displays the top-card from deck and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDrawMany",
                    'descr' => "Post route that 'draws' and displays a number of cards from deck top and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDeal",
                    'descr' => "Post route that 'draws' and displays a number of cards for a number of players and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonGame",
                    'descr' => "Shows current status of game 21",
                    'method' => 'GET',
                ],
            ],
        ];
        return $this->render('landing_json.html.twig', $data);
    }
}
