<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Provider;

use Psr\Container\ContainerInterface;
use SocialBrothers\Interop\ServiceProviderInterface;
use SocialBrothers\Templater\TemplaterInterface;
use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\WpTwig\Twig\TwigTemplater;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

use function array_merge;
use function compact;
use function defined;
use function dirname;
use function do_action;
use function get_footer;
use function get_header;
use function have_posts;
use function parse_blocks;
use function render_block;
use function the_post;

use const ABSPATH;

final class TwigProvider implements ServiceProviderInterface
{
    /**
     * @return array<string, callable>
     */
    public function getFactories(): array
    {
        return array_merge([
            /**
             * Interfaces and class-bindings.
             *
             * @see  LoaderInterface
             *
             * @uses FilesystemLoader
             */
            LoaderInterface::class => static function (ContainerInterface $container): LoaderInterface {
                $root = $container->get('twig.root');

                if ($container->has('twig.root.path')) {
                    return new FilesystemLoader($root, $container->get('twig.root.path'));
                }

                return new FilesystemLoader($root);
            },
            /**
             * Twig Environment factory binding.
             *
             * @see   LoaderInterface
             *
             * @uses  LoaderInterface::class, as key to retrieve the defined loader from the container.
             * @uses  'twig.functions' key to retrieve twig function extensions to be added to Environment, from the container.
             * @uses  'twig.filters'   key to retrieve twig filter extensions to be added to Environment, from the container.
             */
            Environment::class => static function (ContainerInterface $container): Environment {
                $environment = new Environment($container->get(LoaderInterface::class));

                foreach ($container->get('twig.functions') as $key => $closure) {
                    $environment->addFunction(new TwigFunction($key, $closure));
                }

                foreach ($container->get('twig.filters') as $key => $closure) {
                    $environment->addFilter(new TwigFilter($key, $closure));
                }

                if (Theme::isDebug()) {
                    $environment->enableDebug();
                    $environment->addExtension(new DebugExtension());
                }

                $environment->addGlobal('post', []);

                return $environment;
            },
            TemplaterInterface::class => static function (ContainerInterface $container): TemplaterInterface {
                return new TwigTemplater($container->get(Environment::class));
            },
        ], $this->getWordPressFunctionDefinitions(), $this->addExtendableData());
    }

    /**
     * @return array<string, callable>
     */
    private function getWordPressFunctionDefinitions(): array
    {
        $wordpress_definitions = [
            /**
             * Twig Extensions.
             *
             * @see https://twig.symfony.com/doc/3.x/advanced.html
             *
             * twig.functions
             * @see TwigFunction
             * @see https://twig.symfony.com/doc/3.x/advanced.html#functions
             *
             * twig.filters
             * @see TwigFilter
             * @see https://twig.symfony.com/doc/3.x/advanced.html#filters
             */
            'twig.wp.functions' => static function (ContainerInterface $container) {
                /**
                 * do_action, also can be called as action.
                 *
                 * @param string $tag
                 * @param mixed  ...$arguments
                 *
                 * @see do_action()
                 */
                $do_action = $action = static function (string $tag, ...$arguments): void {
                    do_action($tag, ...$arguments);
                };

                /**
                 * apply_filters, also can be called as filter.
                 *
                 * @param string $tag
                 * @param        ...$arguments
                 *
                 * @return mixed
                 *
                 * @see apply_filters()
                 */
                $apply_filters = $filter = static function (string $tag, ...$arguments) {
                    return apply_filters($tag, ...$arguments);
                };

                /**
                 * @see parse_blocks()
                 */
                $parse_blocks = static fn (string $content): array => parse_blocks($content);

                /**
                 * @param array $content
                 *
                 * @return string|null
                 *
                 * @see render_block()
                 */
                $render_block = static fn (array $content): ?string => render_block($content);

                /**
                 * @param string|null $name
                 * @param array       $args
                 *
                 * @return mixed
                 *
                 * @see get_header()
                 */
                $get_header = static fn (string $name = null, array $args = []) => get_header($name, $args);

                /**
                 * @param string|null $name
                 * @param array       $args
                 *
                 * @return mixed
                 *
                 * @see get_footer()
                 */
                $get_footer = static fn (string $name = null, array $args = []) => get_footer($name, $args);

                /**
                 * @return mixed
                 *
                 * @see have_posts()
                 */
                $have_posts = static fn () => have_posts();

                /**
                 * @return string
                 *
                 * @see home_url()
                 */
                $get_home_url = static fn () => home_url('/');
                
                /**
                 * @return string
                 *
                 * @see bloginfo()
                 */
                $bloginfo = static fn () => bloginfo('template_url');

                /**
                 * @return mixed
                 *
                 * @see the_post()
                 */
                $the_post = static fn () => the_post();

                /**
                 * @return string
                 *
                 * @see get_search_query()
                 */
                $get_search_query = static fn () => get_search_query() ? get_search_query() : '';

                return compact(
                    'do_action',
                    'apply_filters',
                    'parse_blocks',
                    'render_block',
                    'get_header',
                    'get_footer',
                    'have_posts',
                    'get_home_url',
                    'bloginfo',
                    'the_post',
                    'get_search_query',
                    'action',
                    'filter',
                );
            },
            'twig.wp.filters' => static function (ContainerInterface $container) {
                return [
                    'translatable' => static fn (string $string) => __($string, $container->get('theme.text_domain')),
                ];
            },
        ];

        /**
         * Only load definitions if WordPress is loaded.
         */
        return defined('ABSPATH')
            ? $wordpress_definitions
            : [];
    }

    /**
     * @return array<string, array<int,string>|callable>
     *
     * @noinspection UsingInclusionReturnValueInspection
     */
    private function addExtendableData(): array
    {
        if (! defined('ABSPATH')) {
            return include dirname(__FILE__, 3) . '/vendor/socialbrothers/wp-twig/config/extensions.php';
        }

        return include ABSPATH . 'vendor/socialbrothers/wp-twig/config/extensions.php';
    }
}
