<?php
defined('ABSPATH') || exit;

add_action('pre_get_posts', function ($query): void {
    if (is_admin() || ! $query->is_main_query() || empty($query->query_vars['post_type']) && ! is_archive()) {
        return;
    }
    $query->set('posts_per_page', 9);

    $filter   = $_GET['category'] ?? '';
    $taxonomy = 'category_' . $query->query_vars['post_type'];

    if (! empty($filter) && $taxonomy) {
        $query->set('tax_query', [
            [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => [$filter],
            ],
        ]);
    }
    $sort = $_GET['sort'] ?? '';

    if (! empty($sort)) {
        if ('title_asc' === $sort || 'title_desc' === $sort) {
            $query->set('orderby', 'title');
        }

        $order = 'DESC';

        if ('date_asc' === $sort || 'title_asc' === $sort) {
            $order = 'ASC';
        }
        $query->set('order', $order);
    }
}, 100);
