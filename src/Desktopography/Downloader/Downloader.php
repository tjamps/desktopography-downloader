<?php
declare(strict_types=1);

namespace Desktopography\Downloader;

interface Downloader
{

    /**
     * @param int $year
     * @return array
     */
    public function getList(int $year): array;

    /**
     * @param string $uri
     * @param string $resolution
     * @return string
     */
    public function getDownloadLink(string $uri, string $resolution = '1920x1080'): string;

    /**
     * @param string $uri
     * @return string
     */
    public function download(string $uri): string;

    /**
     * @param string $uri
     * @return string
     */
    public function extractNameFromUri(string $uri): string;
}
