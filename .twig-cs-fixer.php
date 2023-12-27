<?php


/**
 * Directories to exclude.
 */
$dirs = [
    __DIR__ . '/src',
    __DIR__ . '/tests',
    __DIR__ . '/wp-content/themes/socialbrothers'
];

/**
 * Cache dir and file location.
 */
$cacheDirectory = __DIR__ . '/.var/cache';
$cacheFile      = "{$cacheDirectory}/.twig-cs-fixer.cache";

/**
 * Create a .cache dir if not already present.
 */
if (!file_exists($cacheDirectory) && !mkdir($cacheDirectory, 0700) && !is_dir($cacheDirectory)) {
    throw new RuntimeException(
        sprintf('Directory "%s" was not created', $cacheDirectory)
    );
}

return (new \TwigCsFixer\Config\Config())->setFinder(
    (new \TwigCsFixer\File\Finder())->in($dirs)
);

