<?php
declare(strict_types=1);

namespace Desktopography\Http;

use GuzzleHttp\Client as GuzzleHttpClient;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements Client
{
    /**
     * @var GuzzleHttpClient
     */
    private $guzzle;

    /**
     *
     */
    public function __construct()
    {
        $this->guzzle = new GuzzleHttpClient();
    }

    /**
     * @inheritdoc
     */
    public function get(string $uri): ResponseInterface
    {
        $response = $this->guzzle->get($uri);

        return $response;
    }
}
