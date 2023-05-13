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
    public function standardData(string $page, MdParser $parser = new MdParser()): array
    {
        $filename = "markdown/{$page}.md";
        $parsedText = $parser->getParsedText($filename);
        $data = [
            'title' => ucfirst($page),
            'text' => $parsedText,
            'page' => "{$page}",
            'url' => "{$page}",
        ];

        if ($page === "home") {
            $data['url'] = "/";
        }

        return $data;
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
}
