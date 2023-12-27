<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Helpers;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use SocialBrothers\Theme\Container\ThemeContainer;

use function defined;
use function dirname;
use function error_log;

/**
 * Retrieve a binding from the Plugin's main Container.
 *
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 * @throws ReflectionException
 */
function service(string $id): mixed
{
    if (! ThemeContainer::getInstance()->hasInit()) {
        ThemeContainer::getInstance()->setConfig(include dirname(__DIR__) . '/config/app.php');
    }

    if (! ThemeContainer::getInstance()->has($id)) {
        return false;
    }

    try {
        return ThemeContainer::getInstance()->get($id);
    } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        if (defined('ABSPATH') && WP_ENV !== 'development') {
            error_log($e->getMessage());

            return false;
        }

        throw $e;
    }
}
