<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Bootstrap\Loader;

use Exception;
use InvalidArgumentException;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Traversable;

use function is_dir;
use function is_string;
use function sprintf;

/**
 * Class ThemeFileLoader.
 */
class ThemeFileLoader implements FileLoaderInterface
{
    /**
     * @var Traversable<string,SplFileInfo>
     */
    private Traversable $iterator;

    /**
     * @param string[] $includeDirs
     */
    private function __construct(
        private string $rootPath,
        private array $includeDirs,
        private bool|string $recursive
    ) {
        $this->includeDirs = array_map([$this, 'validatePath'], $this->includeDirs);
    }

    /**
     * @param string      $rootPath           root theme directory path
     * @param string[]    $includeDirectories directories to include, relative to $rootPath
     * @param bool|string $recursive          Defaults to true. Specify if dirs are loaded recursively. A compatible pattern string for `Finder::depth($pattern)` can be passed alternatively.
     * @param bool        $loadFiles          require files automatically on true, otherwise you can only achieve this by looping over this instance and calling require
     *
     * @throws Exception
     */
    public static function createFileLoader(
        string $rootPath,
        array $includeDirectories,
        bool|string $recursive = true,
        bool $loadFiles = true
    ): FileLoaderInterface {
        // @phpstan-ignore-next-line
        $loader = new static($rootPath, $includeDirectories, $recursive);

        if ($loadFiles) {
            $loader->loadFiles();
        }

        return $loader;
    }

    /**
     * @return SplFileInfo[]
     *
     * @throws Exception
     */
    public function getFiles(): array
    {
        return iterator_to_array($this->getIterator());
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validatePath(string $dir): string
    {
        $path = sprintf('%s/%s', $this->rootPath, $dir);

        return ! is_dir($path)
            ? throw new InvalidArgumentException("Could not find directory: \"{$path}\".") : $path;
    }

    /**
     * @throws Exception
     */
    private function loadFiles(): void
    {
        foreach ($this->getIterator() as $file) {
            require_once $file->getRealPath();
        }
    }

    /**
     * @return Traversable<string, SplFileInfo>
     *
     * @throws Exception
     */
    private function getIterator(): Traversable
    {
        yield from $this->iterator ??= $this->createFinder();
    }

    /**
     * @return \Symfony\Component\Finder\Finder<string,SplFileInfo>
     */
    private function createFinder(): Finder
    {
        $finder = Finder::create()
            ->in($this->includeDirs)
            ->name('*.php');

        $pattern = $this->resolveDepthPattern();

        return null === $pattern
            ? $finder
            : $finder->depth($pattern);
    }

    /**
     * Resolve pattern passed to `Finder::depth($pattern)`.
     *
     * When `$this->recursive` is a string, we assume its value is a valid pattern.
     * By default, Finders recursion is enabled, if `$this->recursive` is true or any other uncovered value, we return null.
     * If `$this->recursive` is false, we return the pattern for recursion depth of 0.
     *
     * @see https://symfony.com/doc/current/components/finder.html#directory-depth
     */
    private function resolveDepthPattern(): ?string
    {
        return match (true) {
            is_string($this->recursive) => $this->recursive,
            false === $this->recursive  => '== 0',
            default                     => null,
        };
    }
}
