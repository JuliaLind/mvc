<?php

namespace App\Markdown;

use Anax\TextFilter\TextFilter;

/**
 * Class that reads content from a markdown file and
 * uses TextFilter class to return the content coverted
 * to html
 */
class MdParser
{
    private string $parsedText;

    public function __construct(String $filename)
    {
        /**
         * @var string $content The content of the markdown file.
         */
        $content     = file_get_contents($filename);
        $filter = new TextFilter();
        $parsedContent = $filter->parse($content, ["markdown"]);
        $this->parsedText = $parsedContent->text; // @phpstan-ignore-line
    }

    public function getParsedText(): string
    {
        return $this->parsedText;
    }
}
