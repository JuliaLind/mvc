<?php

namespace App\Markdown;

use Anax\TextFilter\TextFilter;

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
