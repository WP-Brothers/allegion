<?php

declare(strict_types=1);

use SocialBrothers\DI\Config\ContainerConfig;
use SocialBrothers\Theme\Provider\ThemeProvider;
use SocialBrothers\Theme\Provider\TwigProvider;
use SocialBrothers\Vite\Service\Provider\ViteProvider;

$config = __DIR__ . '/theme-config.php';

return ContainerConfig::create()
    ->withProviders([
        ViteProvider::class,
        TwigProvider::class,
        ThemeProvider::class,
    ])
    ->withDefinitions(
        (static fn (): array => include $config)()
    );
