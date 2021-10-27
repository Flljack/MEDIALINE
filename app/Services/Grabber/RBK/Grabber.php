<?php

namespace App\Services\Grabber\RBK;

use App\Services\Grabber\SpiderParent;

class Grabber
{
    const URL = 'https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews.uploaded/lastDate/';
    const LIMIT_URL_PART = '/limit/';
    const LIMIT = 15;
    const HEADERS = ['user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'accept' => 'application/json'];
    const SLEEP = 1;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var string
     */
    private $url;

    /**
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $date = new \DateTime();
        $dateTimestamp = $date->getTimestamp();
        $this->url = self::URL . $dateTimestamp . self::LIMIT_URL_PART . self::LIMIT;
    }

    public function grab()
    {
        $content = SpiderParent::getContent($this->url, self::HEADERS);
        $newsUrls = $this->parser->getNewsUrls($content);
        $newsContent = SpiderParent::getContentFromUrls($newsUrls, self::SLEEP, self::HEADERS);
        dd($newsContent);
    }
}
