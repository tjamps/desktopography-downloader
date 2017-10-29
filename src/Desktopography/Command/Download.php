<?php
declare(strict_types=1);

namespace Desktopography\Command;

use Desktopography\Downloader\Downloader;
use Desktopography\Downloader\Wallpaper;
use Desktopography\Storage\FileStorage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Download extends Command
{
    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var Downloader
     */
    private $downloader;


    protected function configure()
    {
        $this->setName('download')
            ->setDescription('Download images from http://desktopography.net')
            ->addArgument('destination', InputArgument::REQUIRED, 'Directory where images will be downloaded');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->title('Desktopography downloader');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('destination')) {
            $destination = $this->io->ask('Directory where images will be downloaded');
            $input->setArgument('destination', $destination);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = new FileStorage($input->getArgument('destination'));
        $this->downloader = new Wallpaper();

        $years = range(2005, 2017);

        foreach ($years as $year) {
            $this->io->block(sprintf('Downloading exhibition %s', $year));

            $list = $this->downloader->getList($year);

            $this->io->progressStart(count($list));

            foreach ($list as $uri) {
                $name = $this->downloader->extractNameFromUri($uri);
                $link = $this->downloader->getDownloadLink($uri);

                if ($link) {
                    $imageContents = $this->downloader->download($link);
                    $storage->storeImage($year, sprintf('%s.jpg', $name), $imageContents);
                }

                $this->io->progressAdvance();
            }

            $this->io->progressFinish();
        }


        $this->io->success('Download succesful');
    }
}
