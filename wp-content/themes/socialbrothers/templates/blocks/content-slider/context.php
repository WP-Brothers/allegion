<?php

add_filter(
    'wpb_twig_content-slider_context',
    function (array $context): array {
        $slides   = [];
        $post_ids = [];

        if ('custom' === $context['content_option'] && !empty($context['posts'])) {
            $post_ids = $context['posts'];
        } else {
            $post_ids = wp_list_pluck(get_posts([
                'post_type'      => [$context['post_type']],
                'posts_per_page' => 10,
            ]), 'ID');
        }

        foreach ($post_ids as $post_id) {
            $slides[] = wpb_build_post_card_context($post_id);
        }
        $context['slides'] = $slides;

        if (!empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }
        return $context;
    }
);
