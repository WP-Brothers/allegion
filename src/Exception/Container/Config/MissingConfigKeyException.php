<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Exception\Container\Config;

use SocialBrothers\Theme\Exception\Container\MissingImplementationBindingException;
use Throwable;

class MissingConfigKeyException extends MissingImplementationBindingException
{
    /**
     * @param string|null $instructions path to the definition-file where this key should be defined
     */
    public function __construct(string $key, string $instructions = null, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Missing configuration key: "%s"', $key),
            null !== $instructions ? ", you can define it in \"{$instructions}\"" : '',
            $code,
            $previous
        );
    }
}
