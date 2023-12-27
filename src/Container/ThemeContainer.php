<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Container;

use DI\ContainerBuilder;
use LogicException;
use Psr\Container\ContainerInterface;
use ReflectionException;
use SocialBrothers\DI\Builder\Builder;
use SocialBrothers\DI\BuilderInterface;
use SocialBrothers\DI\ContainerConfigInterface;
use SocialBrothers\DI\ContainerProxyTrait;
use SocialBrothers\Interop\ServiceProviderInterface;

use function collect;
use function is_string;
use function sprintf;

class ThemeContainer implements ContainerInterface
{
    use ContainerProxyTrait;

    private static self $instance;

    private ContainerInterface $container;

    private ?ContainerConfigInterface $config;

    final public static function getInstance(): static
    {
        if (! isset(self::$instance)) {
            self::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @throws LogicException|ReflectionException
     */
    protected function getInnerContainer(): ContainerInterface
    {
        return $this->container ?? $this->init()->container;
    }

    public function setConfig(ContainerConfigInterface $config): static
    {
        $this->config = $config;

        return $this;
    }

    final public function hasInit(): bool
    {
        return isset($this->container);
    }

    private function getConfig(): ContainerConfigInterface
    {
        return $this->config;
    }

    /**
     * @throws ReflectionException
     */
    private function getBuilder(): BuilderInterface
    {
        if (isset($this->container)) {
            throw new LogicException('The Builder should only be used for initial Container bootstrapping.');
        }

        return new Builder(function (ContainerConfigInterface $config): ContainerInterface {
            return (new ContainerBuilder())
                ->addDefinitions(
                    collect($config->getProviders())
                        ->map(
                            function (ServiceProviderInterface|string $provider): iterable {
                                if (is_string($provider)) {
                                    $provider = new $provider();
                                }

                                return $provider->getFactories();
                            }
                        )
                        ->add($config->getDefinitions())
                        ->collapse()
                        ->toArray()
                )
                ->build();
        });
    }

    private function __construct()
    {
        $this->config = null;
    }

    /**
     * @throws LogicException|ReflectionException
     */
    private function init(): static
    {
        if (null === $this->config) {
            throw new LogicException(sprintf('No configuration set for: "%s".', __CLASS__));
        }

        $this->container = ($this->getBuilder())($this->getConfig());

        return $this;
    }
}
