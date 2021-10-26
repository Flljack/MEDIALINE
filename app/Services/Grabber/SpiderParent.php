<?php

namespace App\Services\Grabber;

use Illuminate\Support\Facades\Http;
class SpiderParent
{
    const USER_AGENTS = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36';

    /**
     * @param string $url
     * @return string
     * @throws \ErrorException
     */
    public static function getContent(string $url)
    {
        try {
            $response = Http::withHeaders(['user-agent' => self::USER_AGENTS])->get($url);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            throw new \ErrorException('Http request failed');
        }
        return $response->body();
    }
}
