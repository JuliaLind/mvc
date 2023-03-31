<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    #[Route("/lucky", name: "lucky_number")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky_number.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        $filename = "markdown/home.md";
        $text     = file_get_contents($filename);
        $filter   = new \Anax\TextFilter\TextFilter();
        $parsed   = $filter->parse($text, ["shortcode", "markdown"]);
        $data = [
            'home' => $parsed->text
        ];
        return $this->render('home.html.twig', $data);
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        $filename = "markdown/about.md";
        $text     = file_get_contents($filename);
        $filter   = new \Anax\TextFilter\TextFilter();
        $parsed   = $filter->parse($text, ["shortcode", "markdown"]);
        $data = [
            'home' => $parsed->text
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
        ];
        return $this->render('report.html.twig', $data);
    }

    #[Route('/api/quote', name: "quote")]
    public function jsonQuote(): Response
    {
        $quotes = [
            <<<EOD
            “Opportunities don't happen, you create them.” — Chris Grosser
            EOD,
            <<<EOD
            “It is never too late to be what you might have been.” — George Eliot
            EOD,
            <<<EOD
            “Do the best you can. No one can do more than that.” — John Wooden
            EOD,
            <<<EOD
            “Do what you can, with what you have, where you are.” — Theodore Roosevelt
            EOD,
            <<<EOD
            “If you can dream it, you can do it.” — Walt Disney
            EOD
        ];

        $number = random_int(0, count($quotes));

        $data = [
            'quote' => $quotes[$number],
            'timestamp' => date('d-m-y h:i:s'),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}