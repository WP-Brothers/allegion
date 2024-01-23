<?php

/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

use SocialBrothers\Theme\Helper\Twig;
use SocialBrothers\Theme\Helper\Theme;

if (!defined('ABSPATH')) {
    exit;
}

if (!empty($breadcrumb)) {

    echo $wrap_before;

    Twig::render(
        'organisms/breadcrumbs.twig',
        Theme::filter(
            'index_context',
            [
                'breadcrumb' => $breadcrumb,
            ]
        )
    );

    echo $wrap_after;
}
