<?php

namespace App\Controller;

use Anax\TextFilter\TextFilter;

/**
 * Class that reads content from a markdown file and
 * uses TextFilter class to return the content coverted
 * to html
 */
class MdParser
{
    /**
     * Reads data from a markdown file and returns the parsed content
     */
    public function getParsedText(String $filename, TextFilter $filter = new Textfilter()): string
    {
        /**
         * @var string $content The content of the markdown file.
         */
        $content = file_get_contents($filename);
        $parsedContent = $filter->parse($content, ["markdown"]);
        return $parsedContent->text; // @phpstan-ignore-line
    }
}
