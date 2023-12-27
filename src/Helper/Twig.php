<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Helper;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use SocialBrothers\Templater\TemplaterInterface;

use function SocialBrothers\Theme\Helpers\service;

final class Twig
{
    /**
     * @param array<string, mixed> $context
     *
     * @throws ContainerExceptionInterface|NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public static function render(string $template, array $context = []): void
    {
        service(TemplaterInterface::class)->render($template, $context);
    }

    /**
     * @param array<string, mixed> $context
     *
     * @throws ContainerExceptionInterface|NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public static function renderString(string $template, array $context = []): string
    {
        return service(TemplaterInterface::class)->renderString($template, $context);
    }
}
