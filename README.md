# Desktopography downloader

> A PHP script to download all images available on http://desktopography.net/

## Prerequisites

- PHP 7.1+
- Composer

## Installation

```bash
$ git clone git@github.com:tjamps/desktopography-downloader.git
$ composer install
```

And you're good to go.

## Usage

```bash
$ ./desktopography.php DESTINATION_DIRECTORY
```

If you do not specify the destination directory, 
the command will ask you where you want the files to be downloaded.

The images are stored in the following format : 

`<DESTINATION_DIRECTORY>/<EXHIBITION_YEAR>/<FILENAME>.jpg`

Note : you can use path containing tilde (e.g. `~/Images`), 
they will be automatically resolved.

## TODO

- [ ] Download files in parallel
- [ ] Add tests
- [ ] Test command on MacOS and Windows
- [ ] Better code, obviously :D
