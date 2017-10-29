<?php
declare(strict_types=1);

namespace Desktopography\Http;

use Psr\Http\Message\ResponseInterface;

interface Client
{
    /**
     * @param string $uri
     * @return ResponseInterface
     */
    public function get(string $uri): ResponseInterface;

}
