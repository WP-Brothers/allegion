<?php

declare(strict_types=1);

return [
    'theme.text_domain' => '_SBF',
    'theme.supports'    => static function (): array {
        return [
            ['title-tag'],
            ['menus'],
            ['html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']],
            ['post-thumbnails'],
        ];
    },
    'theme.mimes' => static function (): array {
        return [
            'svg' => 'image/svg+xml',
        ];
    },
    /**
     * Path to the twig template root directory, used by socialbrothers/wp-twig package config.
     * If multiple directories are used, pass an array of paths.
     *
     * @see \SocialBrothers\WpTwig\Twig\TwigTemplater
     * @see \Twig\Environment
     * @see \Twig\Loader\FilesystemLoader
     */
    'twig.root'      => ['twig', 'blocks'],
    'twig.root.path' => dirname(__DIR__) . '/templates',
    'wp.block.root'  => dirname(__DIR__) . '/templates/blocks',
    /**
     * Settings required by ViteProvider.
     *
     * @see \SocialBrothers\Vite\Service\Provider\ViteProvider
     */
    'vite.entries'   => ! is_admin() ? ['main.ts'] : ['backend.ts'],
    'vite.dist.path' => dirname(__DIR__) . '/dist',
    'vite.dist.uri'  => get_template_directory_uri() . '/dist',
    'vite.port'      => 5173,
    'vite.host'      => 'http://localhost',
];
