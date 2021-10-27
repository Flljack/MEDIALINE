<?php

namespace App\Services\Grabber\RBK;

use SimpleXMLElement;

class Parser
{
    public function getData($content)
    {
        $feed = (array) new SimpleXmlElement($content);
        //dd(array_keys((array)$feed['channel']));
        $channel = (array)$feed['channel'];//(array)$channel['channel']
        $items = $channel['item'];
        dd($items);
    }
}
