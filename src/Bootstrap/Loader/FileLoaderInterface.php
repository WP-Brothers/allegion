<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Bootstrap\Loader;

/**
 * Class ThemeFileLoader.
 */
interface FileLoaderInterface
{
    /**
     * Define directories from which php files will be auto-included.
     *
     * @param bool|string $recursive either true/false or a pattern compatible with the `Finder::depth()` method
     *
     * @see https://symfony.com/doc/current/components/finder.html#directory-depth
     */
    public static function createFileLoader(string $rootPath, array $includeDirectories, bool|string $recursive = true): self;

    /**
     * Returns an array of the auto-required files.
     */
    public function getFiles(): array;
}
