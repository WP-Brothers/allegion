<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Exception\Container;

use Exception;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

class UndefinedContainerBindingException extends Exception implements ContainerExceptionInterface
{
    public function __construct(string $message, string $instructions = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('"%s"%s.', $message, $instructions ?? ''),
            $code,
            $previous
        );
    }
}
