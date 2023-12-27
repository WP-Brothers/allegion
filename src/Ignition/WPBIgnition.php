<?php

/**
 * @noinspection MissingParentCallInspection
 * @noinspection PhpMissingParentCallCommonInspection
 */

declare(strict_types=1);

namespace SocialBrothers\Theme\Ignition;

use ErrorException;
use Spatie\FlareClient\Report;
use Spatie\Ignition\Ignition;
use Throwable;

use function error_reporting;
use function in_array;
use function set_error_handler;
use function set_exception_handler;

use const E_DEPRECATED;
use const E_USER_DEPRECATED;

class WPBIgnition extends Ignition
{
    public const DEFAULT_IGNORE_SEVERITY = [
        E_DEPRECATED,
        E_USER_DEPRECATED,
    ];

    private ?array $ignoreSeverity = null;

    public static function make(): self
    {
        return new self();
    }

    public function register(): self
    {
        error_reporting(-1);

        /** @phpstan-ignore-next-line  */
        set_error_handler([$this, 'errorHandler']);

        /** @phpstan-ignore-next-line  */
        set_exception_handler([$this, 'handleException']);

        return $this;
    }

    /**
     * @throws ErrorException
     */
    public function errorHandler(int $level, string $message, string $file = '', int $line = 0): bool
    {
        if (in_array($level, $this->getIgnoreSeverity(), true)) {
            return false;
        }

        throw new ErrorException($message, 0, $level, $file, $line);
    }

    public function handleException(Throwable $throwable): Report
    {
        $report = $this->createReport($throwable);

        if ($throwable instanceof ErrorException && in_array($throwable->getSeverity(), $this->getIgnoreSeverity(), true)) {
            return $report;
        }

        if ($this->shouldDisplayException && true !== $this->inProductionEnvironment) {
            $this->renderException($throwable, $report);
        }

        return $report;
    }

    public function setIgnoreSeverity(?array $ignoreSeverity): self
    {
        $this->ignoreSeverity = $ignoreSeverity;

        return $this;
    }

    public function getIgnoreSeverity(): array
    {
        return $this->ignoreSeverity ?? self::DEFAULT_IGNORE_SEVERITY;
    }
}
