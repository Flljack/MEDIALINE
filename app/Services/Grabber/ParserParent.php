<?php

namespace App\Services\Grabber;

use DOMDocument;
use DOMXPath;

class ParserParent
{
    /**
     * @param string $content
     * @return array
     * @throws \ErrorException
     */
    public static function getJsonContent(string $content): array
    {
        $data = json_decode($content, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \ErrorException(json_last_error());
        }
        return $data;
    }

    /**
     * @param string $html
     * @return array
     */
    public static function getAElementsFromHTML(string $html): array
    {
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXpath($doc);
        return iterator_to_array($xpath->query("//a[@href]"));
    }
}
