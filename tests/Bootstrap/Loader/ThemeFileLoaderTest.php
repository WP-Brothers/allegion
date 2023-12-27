<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Bootstrap\Loader;

use PHPUnit\Framework\TestCase;
use SplFileInfo;

use function dirname;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertInstanceOf;
use function reset;

/**
 * @covers \SocialBrothers\Theme\Bootstrap\Loader\ThemeFileLoader
 *
 * @internal
 */
final class ThemeFileLoaderTest extends TestCase
{
    public function testCreateFileLoader(): void
    {
        assertInstanceOf(
            FileLoaderInterface::class,
            ThemeFileLoader::createFileLoader(
                $this->getTestRoot(),
                ['includes'],
                false
            )
        );
    }

    /**
     * @depends testCreateFileLoader
     */
    public function testGetFilesWithoutRecursion(): void
    {
        $files = ThemeFileLoader::createFileLoader($this->getTestRoot(), ['includes'], false)
            ->getFiles();

        assertCount(1, $files);
        assertInstanceOf(SplFileInfo::class, reset($files));
    }

    /**
     * @depends testCreateFileLoader
     */
    public function testGetFilesRecursive(): void
    {
        $files = ThemeFileLoader::createFileLoader($this->getTestRoot(), ['includes'], true)
            ->getFiles();

        assertCount(2, $files);

        foreach ($files as $file) {
            assertInstanceOf(SplFileInfo::class, $file);
        }
    }

    private function getTestRoot(): string
    {
        return dirname(__FILE__, 3) . '/Fixtures/';
    }
}
