<?php

namespace App\Services\Grabber\RBK;

use App\Services\Grabber\ParserParent;



class Parser extends ParserParent
{

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

    public function getNewsData(array $newsContent): array
    {
        return [];
    }
}
