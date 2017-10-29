<?php
declare(strict_types=1);

namespace Desktopography\Storage;

use Symfony\Component\Filesystem\Filesystem;

class FileStorage implements Storage
{

    /**
     * @var string
     */
    private $destination;

    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @param string $destination
     */
    public function __construct(string $destination)
    {
        $this->fs = new Filesystem();
        $this->destination = $destination;
        $this->resolveTildePath();
    }

    /**
     * @inheritDoc
     */
    public function storeImage(int $year, string $name, string $contents)
    {
        $filename = sprintf('%s/%s/%s', $this->destination, $year, $name);
        $this->fs->dumpFile($filename, $contents);
    }

    /**
     *
     */
    private function resolveTildePath()
    {
        if (substr($this->destination, 0, 1) === '~') {
            $home = getenv('HOME');
            $this->destination = str_replace('~', rtrim($home, '/'), $this->destination);
        }

        $this->destination = rtrim($this->destination, '/');
    }
}
