<?php

declare(strict_types=1);

/**
 * Remove comments page in menu.
 */
function wpb_disable_comments_admin_menu(): void
{
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'wpb_disable_comments_admin_menu');

/**
 * Redirect any user trying to access comments page.
 */
function wpb_disable_comments_admin_menu_redirect(): void
{
    global $pagenow;
    if ('edit-comments.php' === $pagenow) {
        wp_redirect(admin_url());

        exit;
    }
}

add_action('admin_init', 'wpb_disable_comments_admin_menu_redirect');
