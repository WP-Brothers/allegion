<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Provider;

use Psr\Container\ContainerInterface;
use SocialBrothers\Interop\ServiceProviderInterface;

use function array_diff;
use function function_exists;
use function scandir;

final class ThemeProvider implements ServiceProviderInterface
{
    /**
     * @return array<string, callable>
     */
    public function getFactories(): array
    {
        return [
            'wp.block.custom-entries' => static function (ContainerInterface $container): array {
                if (! $container->has('wp.block.root')) {
                    return [];
                }

                return array_diff(scandir($container->get('wp.block.root')), ['..', '.']);
            },
            'twig.default.functions' => static function (): array {
                return [
                    /**
                     * $function_name => $function.
                     */
                    'yoast_breadcrumb' => function (): void {
                        if (! function_exists('yoast_breadcrumb')) {
                            return;
                        }

                        $class = 'breadcrumbs';

                        yoast_breadcrumb("<div id=\"breadcrumbs\" class=\"{$class}\">", '</div>');
                    },
                    'wp_get_attachment_image' => function ($attachment_id, $size = 'full', $icon = false, $attr = []): string {
                        return wp_get_attachment_image($attachment_id, $size, $icon, $attr);
                    },
                ];
            },
        ];
    }
}
