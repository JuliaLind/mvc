<?php

namespace App\Helpers;

require __DIR__ . "/../../vendor/autoload.php";

use App\Markdown\MdParser;

/**
 * Helper class to handle the routes in MainController
 */
class MainControllerHelper
{
    /**
     * @return array<string,string>
     */
    public function homeData(MdParser $parser = new MdParser(), string $filename = "markdown/home.md"): array
    {
        $parsedText = $parser->getParsedText($filename);
        return [
            'home' => $parsedText,
            'page' => "home",
            'url' => "/",
        ];
    }

    /**
     * @return array<string,string>
     */
    public function aboutData(MdParser $parser = new MdParser(), string $filename = "markdown/about.md"): array
    {
        $parsedText = $parser->getParsedText($filename);
        return [
            'home' => $parsedText,
            'page' => "about",
            'url' => "/about",
        ];
    }

    /**
     * @return array<string,string>
     */
    public function reportData(MdParser $parser = new MdParser()): array
    {
        $data = [
            'page' => "report",
            'url' => "/report",
        ];
        for ($i = 1; $i <= 7; $i++) {
            $filename = "markdown/kmom0{$i}.md";
            $data["kmom0{$i}"] = $parser->getParsedText($filename);
        }
        return $data;
    }

    /**
     * @return array<string,string>
     */
    public function luckyData(): array
    {
        $top = random_int(3, 25);
        $left = random_int(1, 80);

        $monkey = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: {$left}%; margin-top: {$top}%;" alt="apa">
        EOD;

        return [
            'page' => "lucky",
            'monkey' => $monkey,
            'url' => "/lucky",
        ];
    }
}
