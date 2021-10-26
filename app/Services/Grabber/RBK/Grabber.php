<?php

namespace App\Services\Grabber\RBK;

use App\Services\Grabber\SpiderParent;

class Grabber
{
    const URL = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    public function grab()
    {
        $content = SpiderParent::getContent(self::URL);
    }
}
