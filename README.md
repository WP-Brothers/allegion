# ![SB Logo](sblogo.svg) Social Brothers WP Starter Theme

[![Build Passing](https://img.shields.io/badge/build-passing-green.svg)][pipeline]
[![Questions](https://img.shields.io/badge/questions-slackoverflow-orange)][slack]
![Wordpress version](https://img.shields.io/badge/wordpress-%3E%3D5.7-blue)
![PHP version](https://img.shields.io/badge/PHP-%3E%3D8.0-blue)

A basic WordPress theme used to build WordPress websites and provide an easy workflow during development.
Used by the WordPress team at [Social Brothers](https://socialbrothers.nl/) and [WPBrothers](https://wpbrothers.nl/).

<br />

<a href="https://app.gitbook.com/o/-MdqstAP5EZ-EOVt18c5/s/-MdqsHG76SIWzoaZ0Mbc/" target="_blank"><strong>SB Gitbook »</strong></a>
<a href="https://bitbucket.org/socialbrothers/sb-cli/src/master/" target="_blank"><strong>SB CLI »</strong></a>
<a href="https://composer.sbdev.nl/" target="_blank"><strong>SB Composer »</strong></a>
<br />
<br />
<a href="https://twig.symfony.com/doc/3.x/" target="_blank">🌱 Twig Docs</a> ·
<a href="https://vitejs.dev/guide/" target="_blank">⚡️ Vite Docs</a> ·
<a href="https://app.gitbook.com/o/-MdqstAP5EZ-EOVt18c5/s/-MlK0M_Mcks55sH-wTZv/">📦️ WP & composer</a> ·
<a href="https://bitbucket.org/socialbrothers/sb-vite/src/main/" target="_blank">🟠 SB Vite</a> ·
<a href="https://bitbucket.org/socialbrothers/wp-twig/src/main/" target="_blank">🔶 socialbrothers/wp-twig</a>
<br />

* [Getting started](#getting-started)
    * [Prerequisites](#prerequisites)
    * [Installation](#installation)
* [Code style, Static analysis and Formatting](#code-style-static-analysis-and-formatting)
    * [PHP](#php)
        * [php-cs-fixer](#php-cs-fixer)
        * [PHPStan](#phpstan)
* [Testing](#testing)
    * [PHPUnit](#phpunit)

<!-- TOC --><a name="getting-started"></a>

## Getting started

<!-- TOC --><a name="prerequisites"></a>

### Prerequisites

* PHP `^8.0|^8.1`
  * Composer `^2.3`
  * LocalWP|laravel/valet

* NodeJS `^16.16.0`
  * `yarn`

> **ℹ️ Info:**
> Composer `^2.3` is not a hard requirement but can large differences in versions can cause issues during deployment.

> **⚠️ Warning:**
> PHP `8.1` is currently unsupported by WPEngine as of **12-10-22**.

<!-- TOC --><a name="installation"></a>

### Installation

With [SB CLI](https://bitbucket.org/socialbrothers/sb-cli/src/master/)

```Sh
# Install with
yarn add @wpbrothers/sbcli -D

# Then to init a new project
sbcli init
```

> **ℹ️ Info:**
> Read more about setting up a new project in
> our [gitbook documentation](https://app.gitbook.com/o/-MdqstAP5EZ-EOVt18c5/s/vD2lBXbySEih96pcLJCD/).

<!-- TOC --><a name="code-style-static-analysis-and-formatting"></a>

## Code style, Static analysis and Formatting

<!-- TOC --><a name="php"></a>

### PHP

<!-- TOC --><a name="php-cs-fixer"></a>

#### php-cs-fixer

A code style configuration for `friendsofphp/php-cs-fixer` is included, defined in `.php-cs-fixer.php`. By default,
it includes the `PSR-1` and `PSR-12` presets. You can customise or add rules in `.php-cs-fixer.php` (although following
a single code style-standard is preferred).

To use `php-cs-fixer` without having it necessarily installed globally, a composer script command is also included to
format php code using the provided config file and the vendor binary of `php-cs-fixer`.

To format the projects php files, run the following command in `{project_root}/app/public`:

```shell

# Run php-cs-fixer
composer format:php

# Run twig-cs-fixer
composer format:twig

# Run Both
composer format
```

> **ℹ️
Info** [https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0](https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0)
> is a nifty tool to compose and export a custom code style configuration.

<!-- TOC --><a name="phpstan"></a>

#### PHPStan

In your project root you will find a minimal `.phpstorm.neon` file which is used to configure PHPStan (optional), this
is used to inform PHPStan that the directory `app/public` should be considered the "project root".

<!-- TOC --><a name="testing"></a>

## Testing

<!-- TOC --><a name="phpunit"></a>

### PHPUnit

Included with the package are a set of Unit tests using `phpunit/phpunit`.
For ease of use a composer script command is
defined to run the tests.

The default configuration will be used when using the `test` command, which is defined at `.phpunit.xml`.

Run the following command in `{project_root}/app/public`:

```shell
composer test
```

A code coverage report is generated in `.cache/cov.xml`.

[pipeline]: https://bitbucket.org/socialbrothers/wordpress-starter-theme-test/addon/pipelines/home#!/results/page/1/filters/%5Bstatus=PASSED,SUCCESSFUL%5D

[email]: mailto:wordpress@socialbrothers.nl

[slack]: https://socialbrothers.slack.com/archives/C01TTNAENR1
