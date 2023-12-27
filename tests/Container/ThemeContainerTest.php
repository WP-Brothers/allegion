<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Container;

use LogicException;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use SocialBrothers\Theme\Provider\ThemeProvider;

use function dirname;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

/**
 * @covers \SocialBrothers\Theme\Container\ThemeContainer
 *
 * @internal
 */
final class ThemeContainerTest extends TestCase
{
    public function testGetInstance(): void
    {
        assertInstanceOf(ContainerInterface::class, ThemeContainer::getInstance());
    }

    /**
     * @depends testGetInstance
     */
    public function testHasInitFalseBeforeInit(): void
    {
        assertFalse(ThemeContainer::getInstance()->hasInit());
    }

    /**
     * @depends testHasInitFalseBeforeInit
     */
    public function testThrowsLogicExceptionWithoutConfig(): void
    {
        $this->expectException(LogicException::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        ThemeContainer::getInstance()->get('anything');
    }

    /**
     * @depends testThrowsLogicExceptionWithoutConfig
     */
    public function testSetConfig(): void
    {
        assertInstanceOf(
            ThemeContainer::class,
            ThemeContainer::getInstance()->setConfig(
                include dirname(__DIR__) . '/Fixtures/config.php'
            )
        );
    }

    /**
     * @depends testSetConfig
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testGet(): void
    {
        assertInstanceOf(
            ThemeProvider::class,
            ThemeContainer::getInstance()->get(ThemeProvider::class)
        );
    }

    /**
     * @depends testGet
     */
    public function testHasInitTrueAfterInit(): void
    {
        assertTrue(ThemeContainer::getInstance()->hasInit());
    }
}
