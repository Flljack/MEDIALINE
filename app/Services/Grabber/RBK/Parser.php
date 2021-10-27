<?php

namespace App\Services\Grabber\RBK;

use App\Services\Grabber\ParserParent;
use DOMDocument;
use DOMXPath;

class Parser extends ParserParent
{

    /**
     * XPath patterns
     */
    const TITLE_PATTERN = '//h1';
    const DATE_PATTERN = '//*[@itemprop="datePublished"]';
    const IMAGE_PATTERN = '//div[@itemprop="articleBody"]//img';
    const DESCRIPTION_PATTERN = '(//div[@itemprop="articleBody"])[1]/*[not(contains(@class, "news-bar") or (contains(@class, "article__ticker")) or (contains(@class, "article__inline-item")) or (contains(@class, "banner")) or (contains(@class, "article__clear")) or (contains(@class, "article__social")) or @href  )]';
    const AUTHOR_PATTERN = '//*[@class="article__authors__author__name"]';

    /**
     * @param string $content
     * @return array
     * @throws \ErrorException
     */
    public function getNewsUrls(string $content): array
    {
        $data = $this::getJsonContent($content);
        $urls = [];
        foreach ($data['items'] as $item) {
            $urls[] = $this::getAElementsFromHTML($item['html'])[0]->getAttribute('href');
        }
        return $urls;
    }

    /**
     * @param array $newsContent
     * @return array
     */
    public function getNewsDataArray(array $newsContent): array
    {
        $data = [];
        foreach ($newsContent as $news) {
            $newsData = $this->getNewsData($news);
            if ($newsData) {
                $data[] = $newsData;
            }
        }
        return $data;
    }

    /**
     * @param string $html
     * @return array|null
     */
    public function getNewsData(string $html): ?array
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $data = [];
        $doc->loadHTML($html);
        $xpath = new DOMXpath($doc);
        $titleElement = $xpath->query(self::TITLE_PATTERN)->item(0);
        $dateElement = $xpath->query(self::DATE_PATTERN)->item(0);
        $imageElement = $xpath->query(self::IMAGE_PATTERN)->item(0);
        $authorElement = $xpath->query(self::AUTHOR_PATTERN)->item(0);
        if (is_null($titleElement) || is_null($dateElement) || is_null($authorElement)) {
            return null;
        }
        $title = $titleElement->textContent;
        $author = $authorElement->textContent;
        $date = $dateElement->getAttribute('content');
        $image = null;
        if (!is_null($imageElement)) {
            $image = $imageElement->getAttribute('src');
        }

        $descriptionNodeList = $xpath->query(self::DESCRIPTION_PATTERN);
        $description = '';
        foreach ($descriptionNodeList as $item) {
            $description .= $doc->saveHTML($item);
        }
        $data['title'] = $title;
        $data['author'] = $author;
        $data['description'] = $description;
        $data['date'] = $date;
        $data['source'] = 'rbk.ru';
        $data['image'] = $image;
        return $data;
    }
}
