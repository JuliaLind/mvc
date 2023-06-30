<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

// use App\Markdown\MdParser;

/**
 * Helper class to get data for routes in the main controller
 */
class MainControllerHelper
{
    public MdParser $parser;

    public function __construct(MdParser $parser = new MdParser())
    {
        $this->parser = $parser;
    }
    /**
     * @return array<string,string>
     */
    public function standardData(string $page): array
    {
        $filename = "markdown/{$page}.md";
        $parsedText = $this->parser->getParsedText($filename);
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
    public function reportData(): array
    {
        $data = [
            'page' => "report",
            'url' => "/report",
        ];
        for ($i = 1; $i <= 7; $i++) {
            $filename = "markdown/kmom0{$i}.md";
            $data["kmom0{$i}"] = $this->parser->getParsedText($filename);
        }
        return $data;
    }
}
