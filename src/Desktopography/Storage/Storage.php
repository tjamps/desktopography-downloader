<?php
declare(strict_types=1);

namespace Desktopography\Storage;


interface Storage
{
    /**
     * @param int $year
     * @param string $name
     * @param string $contents
     * @return mixed
     */
    public function storeImage(int $year, string $name, string $contents);
}
