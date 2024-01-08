<?php

add_filter(
    'wpb_twig_carousel_context',
    function (array $context): array {
        $slides   = [];
        $post_ids = [];

        if ('custom' === $context['content_option'] && !empty($context['posts'])) {
            $post_ids = $context['posts'];
        } else {
            if (isset($context['post_type'])) {
                $post_ids = wp_list_pluck(get_posts([
                    'post_type'      => [$context['post_type']],
                    'posts_per_page' => 10,
                ]), 'ID');
            } else {
                $post_ids = [];
            }
        }

        foreach ($post_ids as $post_id) {
            $slides[] = array_merge(
                wpb_build_post_card_context($post_id),
                [
                    'content' => get_the_excerpt($post_id),
                ]
            );
        }
        $context['slides'] = $slides;

        if (!empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }

        $swiper_options = [
            'slidesPerView' => 1.4,
            'spaceBetween'  => 0,
            'swipeDirection' => 'next',
            'navigation' => true,
            'breakpoints'   => [
                768 => [
                    'spaceBetween' => 0,
                ],
            ],
        ];

        if (isset($context['carousel_full_page']) && true === $context['carousel_full_page']) {
            $swiper_options['slidesPerView'] = 1;
        }

        $context['swiper_options'] = json_encode($swiper_options);

        return $context;
    }
);
