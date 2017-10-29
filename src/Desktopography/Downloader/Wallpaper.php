<?php
declare(strict_types=1);

namespace Desktopography\Downloader;

use Desktopography\Http\GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;

class Wallpaper implements Downloader
{

    /**
     * @var string
     */
    const BASE_URL = 'http://desktopography.net';

    /**
     * @var GuzzleClient
     */
    private $httpClient;

    /**
     *
     */
    public function __construct()
    {
        $this->httpClient = new GuzzleClient();
    }

    /**
     * @inheritDoc
     */
    public function getList(int $year): array
    {
        $wallpapers = [];

        $uri = sprintf('%s/exhibition-%s', self::BASE_URL, $year);

        $response = $this->httpClient->get($uri);

        $contents = $response->getBody()->getContents();

        $crawler = new Crawler($contents);

        $nodes = $crawler->filter('.item-wrap .overlay-background');
        foreach ($nodes as $node) {
            $wallpapers[] = $node->getAttribute('href');
        }

        return $wallpapers;
    }

    /**
     * @inheritDoc
     */
    public function getDownloadLink(string $uri, string $resolution = '1920x1080'): string
    {
        $response = $this->httpClient->get($uri);

        $contents = $response->getBody()->getContents();

        $crawler = new Crawler($contents);

        $buttons = $crawler->filter('.wallpaper-button');

        foreach ($buttons as $button) {
            if ($button->textContent === $resolution) {
                return $button->getAttribute('href');
            }
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function download(string $uri): string
    {
        $response = $this->httpClient->get($uri);

        return $response->getBody()->getContents();
    }

    /**
     * @inheritDoc
     */
    public function extractNameFromUri(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $parts = array_filter(explode('/', $path));

        return end($parts);
    }


}
