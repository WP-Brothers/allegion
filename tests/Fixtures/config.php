<?php

declare(strict_types=1);

use SocialBrothers\DI\Config\ContainerConfig;
use SocialBrothers\Theme\Provider\ThemeProvider;

return ContainerConfig::create()
    ->withProviders([
        ThemeProvider::class,
    ])
    ->withDefinitions([
        'vite.entries'   => is_admin() ? ['backend.ts'] : ['main.ts'],
        'vite.dist.path' => dirname(__FILE__, 3) . '/wp-content/themes/socialbrothers/dist',
        'vite.dist.uri'  => '',
        'vite.port'      => 5173,
        'vite.host'      => 'https://sbtweema.test',
    ]);
