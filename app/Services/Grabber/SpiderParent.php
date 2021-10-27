<?php

namespace App\Services\Grabber;

use Illuminate\Support\Facades\Http;
class SpiderParent
{
    const USER_AGENTS = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36';

    /**
     * @param string $url
     * @param array|null $headers
     * @return string
     * @throws \ErrorException
     */
    public static function getContent(string $url, array $headers = null): string
    {
        if (is_null($headers)) {
            $headers = ['user-agent' => self::USER_AGENTS];
        }

        try {
            $response = Http::withHeaders($headers)->get($url);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            throw new \ErrorException('Http request failed');
        }
        return $response->body();
    }

    /**
     * @param array $urls
     * @param int $sleep
     * @param array|null $headers
     * @return array
     * @throws \ErrorException
     */
    public static function getContentFromUrls(array $urls, int $sleep, array $headers = null): array
    {
        $urlsContent = [];
        foreach ($urls as $url) {
            $urlsContent[] = SpiderParent::getContent($url, $headers);
            sleep($sleep);
        }
        return $urlsContent;
    }
}
