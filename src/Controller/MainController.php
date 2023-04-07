<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class MainController extends AbstractController
{
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

    #[Route("/", name: "home")]
    public function home(): Response
    {
        $filename = "markdown/home.md";
        $text     = file_get_contents($filename);
        $filter   = new \Anax\TextFilter\TextFilter();
        $parsed   = $filter->parse($text, ["shortcode", "markdown"]);
        $data = [
            'home' => $parsed->text,
            'page' => "home",
            'url' => "/",
        ];
        return $this->render('home.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function apis(): Response
    {
        $data = [
            'page' => "api",
            'url' => "/api",
            'title' => "Json routes overview",
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
            ],
        ];
        return $this->render('landing.html.twig', $data);
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        $filename = "markdown/about.md";
        $text     = file_get_contents($filename);
        $filter   = new \Anax\TextFilter\TextFilter();
        $parsed   = $filter->parse($text, ["shortcode", "markdown"]);
        $data = [
            'about' => $parsed->text,
            'page' => "about",
            'url' => "/about",
        ];
        return $this->render('about.html.twig', $data);
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        $texts = [
            "markdown/kmom01.md",
            "markdown/kmom02.md",
            "markdown/kmom03.md",
            "markdown/kmom04.md",
            "markdown/kmom05.md",
            "markdown/kmom06.md",
            "markdown/kmom10.md",
        ];

        $parsedTexts = [];

        foreach ($texts as $filename) {
            $text     = file_get_contents($filename);
            $filter   = new \Anax\TextFilter\TextFilter();
            $parsed   = $filter->parse($text, ["shortcode", "markdown"]);
            $parsedText = $parsed->text;
            array_push($parsedTexts, $parsedText);
        }

        $data = [
            'kmom01' => $parsedTexts[0],
            'kmom02' => $parsedTexts[1],
            'kmom03' => $parsedTexts[2],
            'kmom04' => $parsedTexts[3],
            'kmom05' => $parsedTexts[4],
            'kmom06' => $parsedTexts[5],
            'kmom10' => $parsedTexts[6],
            'page' => "report",
            'url' => "/report",
        ];
        return $this->render('report.html.twig', $data);
    }

    // #[Route('/api/quote', name: "quote")]
    // public function jsonQuote(): Response
    // {
    //     $quotes = [
    //         <<<EOD
    //         "Opportunities don't happen, you create them." — Chris Grosser
    //         EOD,
    //         <<<EOD
    //         "It is never too late to be what you might have been." — George Eliot
    //         EOD,
    //         <<<EOD
    //         "Do the best you can. No one can do more than that.” — John Wooden
    //         EOD,
    //         <<<EOD
    //         "Do what you can, with what you have, where you are." — Theodore Roosevelt
    //         EOD,
    //         <<<EOD
    //         "If you can dream it, you can do it." — Walt Disney
    //         EOD
    //     ];

    //     date_default_timezone_set('Europe/Stockholm');


    //     $number = random_int(0, count($quotes)-1);
    //     $time = new \DateTime();
    //     $data = [
    //         'quote' => $quotes[$number],
    //         'timestamp' => $time->format('Y-m-d H:i:s'),
    //     ];

    //     $response = new JsonResponse($data);
    //     $response->setEncodingOptions(
    //         $response->getEncodingOptions() | JSON_PRETTY_PRINT
    //     );
    //     return $response;
    // }
}
