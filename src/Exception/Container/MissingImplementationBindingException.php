<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Exception\Container;

use Throwable;

class MissingImplementationBindingException extends UndefinedContainerBindingException
{
    public function __construct(string $interface, string $instructions = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Missing ContainerBinding for interface: "%s"', $interface),
            null !== $instructions ? ", you can define a factory in \"{$instructions}\"" : '',
            $code,
            $previous
        );
    }
}
